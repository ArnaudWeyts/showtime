@extends('layouts.master')
@section('title')
	@if(isset($show))
		Reviews for {{ $show->title }}
	@else
		Explore reviews
	@endif
@endsection
@section('content')
<div class="content-contain">
	<p class="breadcrumb">
		<a href="{{ @url('/') }}" class="no-linkstyle">Home</a>
		<i class="material-icons align-icon">chevron_right</i>
		@if(isset($show))
			<a href="{{ @url('/shows') }}" class="no-linkstyle">Shows</a>
			<i class="material-icons align-icon">chevron_right</i>
			<a href="{{ @url('/shows') . '/' . $show->id }}" class="no-linkstyle">{{ $show->title }}</a>
			<i class="material-icons align-icon">chevron_right</i>
		@endif
		@if(isset($user))
			<a href="{{ url('/users') }}" class="no-linkstyle">Users</a>
			<i class="material-icons align-icon">chevron_right</i>
			<a href="{{ @url('/users') . '/' . $user->id }}" class="no-linkstyle">{{ $user->username }}</a>
			<i class="material-icons align-icon">chevron_right</i>
		@endif
		Reviews
	</p>
	<div class="flexbox-container">
		@forelse($reviews as $review)
			<div class="review-card mdl-card mdl-shadow--2dp">
		  		<div class="mdl-card__title mdl-card--expand">
		  			<div class="ellipsis-1">
		    			<h2 class="mdl-card__title-text">{{ $review->title }}</h2>
		    		</div>
		    		@if (!isset($show))
		    			<h3 class="mdl-card__subtitle-text">in {{ $review->show_title }}</h3>
		    		@endif
		  		</div>
		  		<div class="review-shortcontent mdl-card__supporting-text ellipsis-3">
		    		{!! nl2br(e($review->shortcontent)) !!}
		  		</div>
		  		<div class="mdl-card__supporting-text">
		  			@if (!isset($user))
						<p class="review-user">
							By <a href="{{ url('/users') . '/' . $review->user_id }}" class=no-linkstyle>{{ $review->username }}</a>
							@if ($review->type == 'verified')
								<i class="material-icons align-icon verified-icon-small">verified_user</i>
							@endif
						</p>
		  			@endif
		    		<!-- SNEAKY RATING FIX WORKS 100% -->
		  			<div class="rating review-rating">
			  			@if ($review->rating == 1)
							<i class="material-icons">star_half</i>
						@endif
			  			@for ($i = 0; $i < $review->rating-1; $i++)
    						@if ($i % 2 == 0)
    							<i class="material-icons">star</i>
							@elseif ($i % 2 != 0)
								@if ($i == $review->rating - 2)
									<i class="material-icons">star_half</i>
								@endif
							@endif
						@endfor
						@for ($i = 0; $i < ($review->rating % 2 == 0 ? 5 : 4 ) - floor($review->rating / 2); $i++)
							<i class="material-icons">star_border</i>
						@endfor
					</div>
		  		</div>
			  	<div class="mdl-card__actions mdl-card--border">
				    <a href="{{ @url('/reviews') . '/' . $review->id }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				      View review
				    </a>
			  	</div>
			</div>
		@empty
			@if(isset($user))
				<p class="notfound-message">This user hasn't written any reviews yet.</p>
			@elseif(isset($show))
				<p class="notfound-message">Be the first one to write a review for this show!</p>
			@endif
		@endforelse
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="filler"></div>
		<div class="fab-addreview">
		@if(!isset($user))
			@if(isset($show))
				<a href="{{ url('/shows') . '/' . $show->id . '/reviews/add' }}" id="writeReviewButton" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored fab-addreview">
			@else
				<a href="{{ url('/show/choose') }}" id="writeReviewButton" class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored fab-addreview">
			@endif
		  		<i class="material-icons">add</i>
				</a>
				<div class="mdl-tooltip mdl-tooltip--left mdl-tooltip--large" for="writeReviewButton">
					Write a review
				</div>
		@endif
		</div>
	</div>
	@include('pagination.default', ['paginator' => $reviews])
</div>
@endsection