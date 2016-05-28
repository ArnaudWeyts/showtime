@extends('layouts.master')
@section('title', 'Explore shows')
@section('headlinks')
	<!--getmdl-select-->
   <script src="{{ asset('js/getmdl-select.min.js') }}"></script>
   <link rel="stylesheet" href="{{ asset('css/getmdl-select.min.css') }}">
@endsection
@section('content')
<style type="text/css">
	.inner-container {
		margin: 1rem;
	}
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
		max-width: 45rem;
		min-height: 30rem;
		flex-basis: 25rem;
	}
	.show-title__overview {
		width: 100%;
		color: #FFF;
	}
	.searchform-large {
		margin: 1rem;
	}
	.searchform-dropdown {
		margin: 0 1rem;
	}
	@media(max-width: 70rem) {
		.show-card {
			flex-basis: 20rem;
		}
		.filler {
			flex-basis: 20rem;
		}
	}
</style>
<div class="content-contain">
	<p class="breadcrumb">
		<a href="{{ url('/')}}" class="no-linkstyle">Home</a>
		<i class="material-icons align-icon">chevron_right</i>
		Shows
	</p>
	<form action="{{ url('/search') }}" method="GET" class="searchform-large">
		<div class="mdl-textfield mdl-js-textfield">
	    	<input class="mdl-textfield__input" type="text" id="show" name="s" value="{{ old('s') }}">
	    	<label class="mdl-textfield__label" for="show">Enter a show</label>
	  	</div>
	  	<div class="mdl-textfield mdl-js-textfield getmdl-select searchform-dropdown">
      		<input class="mdl-textfield__input" name="c" value="{{ old('c') }}" type="text" id="category" readonly tabIndex="-1"/>
        	<label class="mdl-textfield__label" for="category">
        		Category <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
        	</label>
	        <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="category">
	        	<li class="mdl-menu__item" value="all">All</li>
	       		@foreach($categories as $category)
	          		<li class="mdl-menu__item" value="{{ $category->name }}">{{ $category->name }}</li>
	          	@endforeach
	        </ul>
    	</div>
    	<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent searchform-submit">
  			Search
		</button>
	</form>
	<div class="flexbox-container">
		@forelse($shows as $show)
			<div class="show-card mdl-card mdl-shadow--2dp">
		  		<a href="{{ url('/shows') . '/' . $show->show_id }}" class="mdl-card__title mdl-card--expand show-title__overview no-linkstyle" style="background: linear-gradient(rgba(0, 0, 0, 0.2),rgba(0, 0, 0, 0.2)),url({{ asset('/img/shows') . '/' . $show->show_id . '.jpg'}}) center / cover; ">
		    		<h2 class="mdl-card__title-text">{{ $show->title }}</h2>
		    		<h3 class="mdl-card__subtitle-text"></h3>
		  		</a>
		  		<div class="mdl-card__supporting-text">
		    		{{ $show->description }}
		  		</div>
		  		<div class="mdl-card__supporting-text rating review-rating">
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
		  		</div>
			  	<div class="mdl-card__actions mdl-card--border center-text">
				    <a href="{{ url('/shows') . '/' . $show->show_id }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				        View show
				    </a>
				    <a href="{{ url('/shows') . '/' . $show->show_id . '/reviews' }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
						Reviews ({{ $show->numreviews }})
				    </a>
			  	</div>
			</div>
		@empty
			<p class="notfound-message">No shows were found!</p>
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
	@include('pagination.default', ['paginator' => $shows])
</div>
@endsection