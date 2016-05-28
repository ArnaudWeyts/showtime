<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Show;
use App\Review;
use App\Vote;
use App\User;
use App\Policies\ReviewPolicy;
use Auth;

class UserController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
	}

	public function addReview($id) {
        $show = Show::where('id', '=', $id)
        ->first();
        return view('admin.add', ['show' => $show]);
    }

    public function storeReview(Request $request, $id) {
        if ($request->input('extended') == "extended") {
            $this->validate($request, [
                'title' => 'required|max:125',
                'shortcontent' => 'required|max:200',
                'content' => 'required',
                'rating' => 'required'
            ]);
        }
        else {
             $this->validate($request, [
                'title' => 'required|max:125',
                'shortcontent' => 'required|max:200',
                'rating' => 'required'
            ]);
        }

        // update numreviews
        $show = Show::where('id', '=', $id)
        ->first();
        $numreviews = $show->numreviews;
        $show->numreviews = ($numreviews) + 1;

        // update the rating of the show
        $show->rating = round(($show->rating * $show->numreviews-1 + $request->input('rating')) / $show->numreviews);

        $show->updated_at = \Carbon\Carbon::now();
        $show->save();

        // insert into database
        $review = new Review;
        $review->title = $request->input('title');
        $review->shortcontent = $request->input('shortcontent');
        if ($request->input('extended') == "extended") {
            $review->content = $request->input('content');
        }
        $review->rating = $request->input('rating');
        $review->user_id = Auth::user()->id;
        $review->show_id = $id;
        $review->save();

        return redirect()->route('default::showDetail', $id);
    }

    public function editReview($id) {
        $review = Review::find($id);
        if (!isset($review) || $review->user_id != Auth::user()->id) {
            return redirect()->route('default::home');
        }
        $show = Show::find($review->show_id);
        return view('admin.edit', ['show' => $show, 'review' => $review]);
    }

    public function updateReview(Request $request, $id) {
        if ($request->input('extended') == "extended") {
            $this->validate($request, [
                'title' => 'required|max:125',
                'shortcontent' => 'required|max:200',
                'content' => 'required',
                'rating' => 'required'
            ]);
        }
        else {
             $this->validate($request, [
                'title' => 'required|max:125',
                'shortcontent' => 'required|max:200',
                'rating' => 'required'
            ]);
        }

        // update review
        $review = Review::find($id);
        $review->title = $request->input('title');
        $review->shortcontent = $request->input('shortcontent');
        if ($request->input('extended') == "extended") {
            $review->content = $request->input('content');
        }
        else {
            $review->content = null;
        }
        $review->rating = $request->input('rating');
        $review->save();

        return redirect()->route('user::dashboard');
    }

    public function deleteReview($id) {
        $review = Review::findOrFail($id);
        // check if user is authorized to delete this review
        $this->authorize('destroy', $review);
        $review->delete();
        return redirect()->route('user::dashboard');
    }

    public function chooseShow() {
        $shows = Show::all();
    	return view('admin.choose', ['shows' => $shows]);
    }

    public function chooseShowPost(Request $request) {
        $this->validate($request, [
            'show' => 'required'
        ]);
        return redirect()->route('user::addreview', $request->input('show'));
    }

	public function dashboard() {
        $reviews = Review::orderby('reviews.updated_at', 'asc')
        ->where('user_id', '=', Auth::user()->id)
        ->join('shows', 'reviews.show_id', '=', 'shows.id')
        ->select('reviews.id', 'show_id', 'reviews.title', 'reviews.created_at', 'reviews.updated_at', 'downvotes', 'upvotes', 'shows.title AS show_title')
        ->get();
		return view('admin.dashboard', ['reviews' => $reviews]);
	}

    public function vote(Request $request, $id) {
        $upvote = $request['upvote'] === 'true';
        $update = false;
        $review = Review::find($id);
        if (!$review) {
            return null;
        }
        // get user who votes, and get user who made review
        $user = Auth::user();
        $reviewUser = User::find($review->user_id);
        $vote = $user->votes()->where('review_id', '=', $id)->first();

        // check if a vote exists
        if ($vote) {
            $current_vote = $vote->upvote;
            $update = true;
            // check if vote has to become neutral aka deleted
            if ($current_vote == $upvote) {
                $vote->delete();
                if ($upvote) {
                    // delete previous upvote
                    $review->upvotes = $review->upvotes - 1;
                }
                else {
                    // delete previous downvote
                    $review->downvotes = $review->downvotes - 1;
                }
                $review->save();
                // update the user's karma
                $reviewUser->karma = $review->upvotes - $review->downvotes;
                $reviewUser->save();
                return null;
            }
        }
        // make a new vote
        else {
            $vote = new Vote();
            $vote->user_id = $user->id;
            $vote->review_id = $id;
        }
        $vote->upvote = $upvote;
        // add upvote/downvote to review
        if ($upvote) {
            // remove the downvote if there is one
            if ($update == true) {
                $review->downvotes = $review->downvotes - 1;
            }
            // add an upvote
            $review->upvotes = $review->upvotes + 1;
        }
        else {
            // remove the upvote if there is one
            if ($update == true) {
                $review->upvotes = $review->upvotes - 1;
            }
            // add a downvote
            $review->downvotes = $review->downvotes + 1;
        }
        // current vote is changed, not deleted
        $vote->save();
        // update the review
        $review->save();
        // update the user's karma
        $reviewUser->karma = $review->upvotes - $review->downvotes;
        $reviewUser->save();
        return null;
    }

    public function editUser() {
        $user = User::find(Auth::user()->id);
        return view('admin.editprofile', ['user' => $user]);
    }

    public function updateUser(Request $request) {
        $user = User::find(Auth::user()->id);
        $this->validate($request, [
            'username' => 'required|max:35|unique:users,username'.$user->id,
            'firstname' => 'max:35',
            'lastname' => 'max:35',
            'location' => 'max:100',
            'bio' => 'max:200'
        ]);


        // update the user
        $user->username = $request->input('username');
        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->location = $request->input('location');
        $user->bio = $request->input('bio');

        $user->save();

        return redirect()->route('default::userDetail', $user->id);
    }
}
