@extends('layouts.master')
@section('title', 'Review by ' . $review->username)
@section('content')
<style>
	.fullreview-titles {
		float: left;
		width: 66%;
	}
	.fullreview-author {
		font-style: italic;
	}
	.reviewdetail-interactions {
		margin-top: 3.2rem;
		width: 33%;
		max-width: 15rem;
		float: right;
	}
	.reviewdetail-votebar {
		border-radius: 1px;
	}
	.reviewdetail-votebuttons {
		float: right;
		margin: 0.5rem 0;
	}
	.fullreview-allcontent {
		clear: both;
	}
	.fullreview-editbutton {
		margin-top: -0.3rem;
	}
	.vote {
		color: grey;
	}
	.vote:first-of-type {
		margin-right: 0.5rem;
	}
	.reviewdetail-votebar__upvote {
		float: left;
		height: 0.2rem;
		@if($review->novotes != 1)
			width: {!! $review->upvote_percent !!}%;
			background-color: #4CAF50;
		@else
			width: 50%;
			background-color: grey;
		@endif
	}
	.reviewdetail-votebar__downvote {
		float: right;
		height: 0.2rem;
		@if($review->novotes != 1)
			width: {!! $review->downvote_percent !!}%;
			background-color: #f44336;
		@else
			width: 50%;
			background-color: grey;
		@endif
	}
	@media(max-width: 45rem) {
		.fullreview-titles {
			float: none;
			width: 100%;
		}
		.reviewdetail-interactions {
			margin-top: 1rem;
			float: none;
			width: 50%;
		}
	}
</style>
<div class="content-contain">
	<p class="breadcrumb">
		<a href="{{ url('/')}}" class="no-linkstyle">Home</a>
		<i class="material-icons align-icon">chevron_right</i>
		<a href="{{ url('/shows') }}" class="no-linkstyle">Shows</a>
		<i class="material-icons align-icon">chevron_right</i>
		<a href="{{ url('/shows') .  '/' . $review->show_id }}" class="no-linkstyle">{{ $review->show_title }}</a>
		<i class="material-icons align-icon">chevron_right</i>
		<a href="{{ url('/shows') .  '/' . $review->show_id . '/reviews' }}" class="no-linkstyle">Reviews</a>
		<i class="material-icons align-icon">chevron_right</i>
		{{ $review->title }}
	</p>
	<article class="fullreview">
		<div class="fullreview-titles">
			<h1 class="fullreview-title">{{ $review->title }} 
			@if(!Auth::guest() && Auth::user()->id == $review->user_id)
				<a href="{{ url('/reviews') . '/' . $review->id . '/edit' }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect fullreview-editbutton" id="editReviewButton">
					<i class="material-icons align-icon">edit</i>
				</a>
				<div class="mdl-tooltip mdl-tooltip--right mdl-tooltip--large" for="editReviewButton">
					Edit this review
				</div>
			@endif</h1>
			<h3 class="fullreview-author">Written by <a class="no-linkstyle" href="{{ url('/users') . '/' . $review->user_id }}">{{ $review->username }}</a> on {{ date('F d, Y H:i', strtotime($review->created_at)) }}</h3>
		</div>
		<div class="reviewdetail-interactions">
			<div class=reviewdetail-votebar>
				<div class="reviewdetail-votebar__upvote"></div>
				<div class="reviewdetail-votebar__downvote"></div>
			</div>
			<div class="reviewdetail-votebuttons">
				@if(isset($vote))
					@if($vote->upvote == 1)
						<a href="#" class="no-linkstyle vote" data-value="true">
							<i class="material-icons align-icon upvote-color" id="upvote">thumb_up</i>
							{{ $review->upvotes }}
						</a>
						<a href="#" class="no-linkstyle vote" data-value="false">
							<i class="material-icons align-icon" id="downvote">thumb_down</i>
							{{ $review->downvotes }}
						</a>
					@else
						<a href="#" class="no-linkstyle vote" data-value="true">
							<i class="material-icons align-icon" id="upvote">thumb_up</i>
							{{ $review->upvotes }}
						</a>
						<a href="#" class="no-linkstyle vote" data-value="false">
							<i class="material-icons align-icon downvote-color" id="downvote">thumb_down</i>
							{{ $review->downvotes }}
						</a>
					@endif
				@else
					<a href="#" class="no-linkstyle vote" data-value="true">
						<i class="material-icons align-icon" id="upvote">thumb_up</i>
						{{ $review->upvotes }}
					</a>
					<a href="#" class="no-linkstyle vote" data-value="false">
						<i class="material-icons align-icon" id="downvote">thumb_down</i>
						{{ $review->downvotes }}
					</a>
				@endif
			</div>
		</div>
		<div class="fullreview-allcontent">
			<p class="fullreview-shortcontent">{!! nl2br(e($review->shortcontent)) !!}</p>
			@if(isset($review->content))
				<hr>
				<div class="fullreview-content">{!! $review->content !!}</div>
			@endif
		</div>
	</article>
</div>
<script>
	var token = '{{ Session::token() }}';
	var urlVote = '{{ route('user::vote', $review->id) }}';
	var votes = document.getElementsByClassName('vote');
	var voteFunction = function(event, vote) {
		event.preventDefault();
		var upvote = vote.getAttribute("data-value");
		var done = function() {
    		if (upvote === 'true') {
    			upvoteicon = document.getElementById("upvote");
    			upvoteicon.className = upvoteicon.className == "material-icons align-icon upvote-color" ? "material-icons align-icon" : "material-icons align-icon upvote-color";
    			document.getElementById("downvote").className = "material-icons align-icon";
    		}
    		else {
    			downvoteicon = document.getElementById("downvote");
    			downvoteicon.className = downvoteicon.className == "material-icons align-icon downvote-color" ? "material-icons align-icon" : "material-icons align-icon downvote-color";
    			document.getElementById("upvote").className = "material-icons align-icon";
    		}
    	};
    	ajax.post(urlVote, {upvote: upvote, _token: token }, done);
	};
	for (var i = 0; i < votes.length; i++) {
		votes[i].addEventListener('click', function(event) {
			if(!event) event = window.event;
			voteFunction(event, this);
		});
	};

	// snippet to easily send ajax requests lol i'm lazy
	var ajax = {};
	ajax.x = function () {
	    if (typeof XMLHttpRequest !== 'undefined') {
	        return new XMLHttpRequest();
	    }
	    var versions = [
	        "MSXML2.XmlHttp.6.0",
	        "MSXML2.XmlHttp.5.0",
	        "MSXML2.XmlHttp.4.0",
	        "MSXML2.XmlHttp.3.0",
	        "MSXML2.XmlHttp.2.0",
	        "Microsoft.XmlHttp"
	    ];

	    var xhr;
	    for (var i = 0; i < versions.length; i++) {
	        try {
	            xhr = new ActiveXObject(versions[i]);
	            break;
	        } catch (e) {
	        }
	    }
	    return xhr;
	};

	ajax.send = function (url, callback, method, data, async) {
	    if (async === undefined) {
	        async = true;
	    }
	    var x = ajax.x();
	    x.open(method, url, async);
	    x.onreadystatechange = function () {
	        if (x.readyState == 4) {
	            callback(x.responseText)
	        }
	    };
	    if (method == 'POST') {
	        x.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	    }
	    x.send(data)
	};

	ajax.get = function (url, data, callback, async) {
	    var query = [];
	    for (var key in data) {
	        query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
	    }
	    ajax.send(url + (query.length ? '?' + query.join('&') : ''), callback, 'GET', null, async)
	};

	ajax.post = function (url, data, callback, async) {
	    var query = [];
	    for (var key in data) {
	        query.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
	    }
	    ajax.send(url, callback, 'POST', query.join('&'), async)
	};

</script>
@endsection