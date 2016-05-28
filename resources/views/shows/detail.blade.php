@extends('layouts.master')
@section('title', $show->title)
@section('content')
	<style type="text/css">
		.flexbox-container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: flex-start;
			align-content: flex-start;
			align-items: flex-start;
		}
		.show-card {
			margin: 1rem;
			flex-grow: 1;
			min-width: 20rem;
			width: 100%;
			min-height: 35rem;
			flex-basis: 100%;
		}
		.show-content {
			width: 96%;
			padding-left: 2%;
			padding-right: 2%;
		}
		.show-info {
			float: left;
			width: 40%;
		}
		.show-video {
			float: right;
			width: 55%;
			height: 315px;
		    border-top-left-radius: 2px;
		    border-top-right-radius: 2px;
		    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .14), 0 3px 1px -2px rgba(0, 0, 0, .2), 0 1px 5px 0 rgba(0, 0, 0, .12);
		    overflow:hidden;
		    position:relative;
		}
		.show-title__detail {
			width: 100%;
			color: #FFF;
			min-height: 15rem;
		}
		.show-title-text {
			align-self: flex-start;
			font-size: 3rem;
		}
		.mdl-card__subtitle-text {
			color: #FFF;
		}
		.center-text {
			text-align: center;
		}
		.title-reviews {
			margin: 1rem;
		}
		@media(max-width: 55rem) {
			.show-info {
				clear: both;
				width: 100%;
			}
			.show-video {
				clear: both;
				width: 100%;
			}
		}
	</style>
	<div class="content-contain">
		<div class="flexbox-container">
			<p class="breadcrumb">
				<a href="{{ url('/')}}" class="no-linkstyle">Home</a>
				<i class="material-icons align-icon">chevron_right</i>
				<a href="{{ url('/shows') }}" class="no-linkstyle">Shows</a>
				<i class="material-icons align-icon">chevron_right</i>
				{{ $show->title }}
			</p>
			<div class="show-card mdl-card mdl-shadow--2dp">
		  		<a href="{{ url('/shows') . '/' . $show->id }}" class="mdl-card__title mdl-card--expand show-title__detail no-linkstyle" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url({{ asset('/img/shows') . '/' . $show->id . '.jpg'}}) center / cover; ">
		    		<h2 class="mdl-card__title-text show-title-text">{{ $show->title }}</h2>
		    		<h3 class="mdl-card__subtitle-text">{{ $show->numepisodes }} Episodes</h3>
		  		</a>
		  		<div class="mdl-card__supporting-text show-content">
		  			<div  class="show-info">
		  				<p>{{ $show->description }}</p>
			  			<p>
			  				<i class="material-icons align-icon">label_outline</i>
			  				@foreach($categories as $index => $category)
								@if($index != count($categories)-1)
									{{ $category->name }},
								@else
								 	{{ $category->name }}
								@endif
							@endforeach
			  			</p>
			  			<p><i class="material-icons align-icon">person_outline</i> {{ $show->creatorname }}</p>
			  			<p><i class="material-icons align-icon">tv</i> {{ $show->numseasons }}
			  				@if($show->numseasons != 1)
			  					Seasons
			  				@else
			  					Season
			  				@endif
			  			</p>
			  			<p>
			  				{{ $show->releaseyear}}
			  				<i class="material-icons align-icon">chevron_right</i>
			  				@if ($show->endyear != null)
			  					{{ $show->endyear }}
			  				@else
			  					Ongoing
			  				@endif
			  			</p>
			  			<p class="rating show-rating">
			  				<!-- SNEAKY RATING FIX WORKS 100% -->
				  			@if ($show->rating == 1)
								<i class="material-icons">star_half</i>
							@endif
				  			@for ($i = 0; $i < $show->rating-1; $i++)
								@if ($i % 2 == 0)
									<i class="material-icons">star</i>
								@elseif ($i % 2 != 0)
									@if ($i == $show->rating - 2)
										<i class="material-icons">star_half</i>
									@endif
								@endif
							@endfor
							@for ($i = 0; $i < ($show->rating % 2 == 0 ? 5 : 4 ) - floor($show->rating / 2); $i++)
								<i class="material-icons">star_border</i>
							@endfor
			  			</p>
			  		</div>
			  		<div class="show-video">
				  		@if ($show->trailerurl)
			  				<iframe class="iframe" width="100%" height="315"
			  					src="{{ $show->trailerurl }}" frameborder="0" allowfullscreen>
			  				</iframe>
				  		@else
				  			<p class="center-text">No trailer available</p>
				  		@endif
					</div>
		  		</div>
			</div>
		 </div>
		 <h3 class="title-reviews">
		 	Reviews
		 	<a href="{{ url('/shows') . '/' . $show->id . '/reviews/add' }}" id="writeReviewButton" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
  				<i class="material-icons">add</i>
			</a>
			<div class="mdl-tooltip mdl-tooltip--large" for="writeReviewButton">
				Write a review
			</div>
		</h3>
		 <div class="flexbox-container">
			@forelse($reviews as $review)
				<div class="review-card mdl-card mdl-shadow--2dp">
			  		<div class="mdl-card__title mdl-card--expand">
			  			<div class="ellipsis-1">
			    			<h2 class="mdl-card__title-text">{{ $review->title }}</h2>
			    		</div>
			  		</div>
			  		<div class="review-shortcontent mdl-card__supporting-text ellipsis-1">
			    		{{ $review->shortcontent }}
			  		</div>
			  		<div class="mdl-card__supporting-text">
			  			<p class="review-user">
			  				By <a href="{{ url('/users') . '/' . $review->user_id }}" class="no-linkstyle">{{ $review->username }}</a>
							@if ($review->type == 'verified')
								<i class="material-icons align-icon verified-icon-small">verified_user</i>
							@endif
			  			</p>
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
				<p class="notfound-message">Be the first one to write a review!</p>
			@endforelse
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
			<div class="filler"></div>
		</div>
	</div>
@endsection