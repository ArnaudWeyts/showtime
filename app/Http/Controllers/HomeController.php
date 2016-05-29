<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Review;
use App\Show;
use App\User;
use App\Category;
use Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function reviewOverview() {
        $reviews = Review::orderBy('reviews.updated_at', 'desc')
        ->join('shows', 'reviews.show_id', '=', 'shows.id')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->select('reviews.id', 'reviews.title', 'shortcontent', 'shows.title AS show_title', 'reviews.rating', 'username', 'user_id', 'type')
        ->paginate(9);
        return view('reviews.overview', ['reviews' => $reviews]);
    }

    public function reviewOverviewShow($id) {
        $show = Show::where('id', '=', $id)
        ->first();
        $reviews = Review::where('show_id', '=', $id)
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->select('reviews.id', 'reviews.title', 'shortcontent', 'reviews.rating', 'username', 'user_id', 'type')
        ->orderBy('reviews.updated_at', 'desc')
        ->paginate(9);
        return view('reviews.overview', ['reviews' => $reviews, 'show' => $show]);
    }

    public function reviewOverviewUser($id) {
        $user = User::where('id', '=', $id)
        ->first();
        $reviews = Review::where('user_id', '=', $id)
        ->join('shows', 'reviews.show_id', '=', 'shows.id')
        ->select('reviews.id', 'reviews.title', 'shortcontent', 'shows.title AS show_title', 'reviews.rating')
        ->orderby('reviews.updated_at', 'desc')
        ->paginate(9);
        return view('reviews.overview', ['reviews' => $reviews, 'user' => $user]);
    }

    public function reviewDetail($id) {
        $review = Review::where('reviews.id', '=', $id)
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->join('shows', 'reviews.show_id', '=', 'shows.id')
        ->select('reviews.id', 'reviews.title', 'shortcontent', 'content', 'reviews.rating', 'upvotes', 'downvotes', 'reviews.created_at', 'show_id', 'shows.title AS show_title', 'user_id', 'username', 'type')
        ->first();
        if (empty($review)) {
            return redirect()->route('default::home');
        }
        if (!Auth::guest()) {
             $vote = Auth::user()
            ->votes()
            ->where('review_id', '=', $id)
            ->first();
        }
        else {
            $vote = null;
        }
        $sum = $review->upvotes + $review->downvotes;
        if ($sum != 0) {
            $review['upvote_percent'] = round($review->upvotes / $sum * 100);
            $review['downvote_percent'] = round($review->downvotes / $sum * 100);
        }
        else {
            $review['novotes'] = 1;
        }
        return view('reviews.detail', ['review' => $review, 'vote' => $vote]);
    }

    public function showDetail($id) {
        $show = Show::find($id);
        $categories = $show->categories()->get();;
        $reviews = Review::where('show_id', '=', $id)
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->select('reviews.id', 'reviews.title', 'shortcontent', 'reviews.rating', 'username', 'user_id', 'type')
        ->get();
        if (empty($show)) {
            return redirect()->route('default::home');
        }
        return view('shows.detail', ['show' => $show, 'categories' => $categories, 'reviews' => $reviews]);
    }

    public function userOverview() {
        $users = User::orderby('username', 'asc')
        ->get();
        return view('users.overview', ['users' => $users]);
    }

    public function userDetail($id) {
        $user = User::where('id', '=', $id)
        ->first();
        if (empty($user)) {
            return redirect()->route('default::home');
        }
        return view('users.detail', ['user' => $user]);
    }

    public function showOverview(Request $request) {
        $request->flash();
        $shows = Show::select('shows.id AS show_id', 'title', 'description', 'numreviews', 'rating');
        if ($request->c && $request->c != 'All') {
            $shows = Show::join('categories', 'shows.id', '=', 'categories.show_id')
            ->where('categories.name', '=', $request->c);
            if ($request->s) {
                $shows->where('title', 'LIKE', '%' . $request->s . '%');
            }
        }
        else if ($request->s) {
            $shows= Show::where('title', 'LIKE', '%' . $request->s . '%')
            ->select('shows.id AS show_id', 'title', 'description', 'numreviews', 'rating');
        }
        $shows = $shows->orderBy('numreviews', 'desc')
        ->paginate(6);

        $categories = Category::orderBy('name', 'asc')
        ->groupBy('name')
        ->get();
        return view('shows.overview', ['shows' => $shows, 'categories' => $categories]);
    }
}
