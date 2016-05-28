@extends('layouts.master')
@section('title', 'Home')
@section('content')
	<style type="text/css">
		.banner {
			height: 29rem;
			background-image: url("{{ asset('img/home/banner.jpg') }}");
			background-size: cover;
			background-position: center;
		}
		.banner-card {
			width: auto;
			max-width: 25rem;
			margin: 1rem;
		}
		.article-card {
			margin: 1rem 0;
			width: 48%;
			float: left;
		}
		.article-card:nth-of-type(odd) {
			margin-right: 2%;
		}
		.article-title {
			color: #fff;
			width: 100%;
			height: 15rem;
			background: url("{{ asset('img/home/liftoff.jpg') }}") center / cover;
		}
		.article-container {
			margin: 0 1rem;
		}
		@media(max-width: 70rem) {
			.article-card {
				width: 100%;
				margin: 1rem 0;
			}
		}
	</style>
	<div class="banner">
		<div class="content-contain">
			<div class="mdl-card mdl-shadow--2dp banner-card">
		  		<div class="mdl-card__title">
		    		<h2 class="mdl-card__title-text">Welcome</h2>
		  		</div>
				<div class="mdl-card__supporting-text">
				    <p>Showtime is a website for reviewing tv-shows. Anyone can write a review, so you're the one in charge.</p>
				    <p>Can't wait to start writing reviews for your favourite tv-show? Click the button below!</p>
				</div>
			  	<div class="mdl-card__actions mdl-card--border">
			    	<a href="{{@url('/register')}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
			      	Get Started
			    	</a>
			  	</div>
			</div>
		</div>
	</div>
	<div class="content-contain">
		<div class="article-container">
			<div class="mdl-card mdl-shadow--2dp article-card">
		  		<div class="mdl-card__title article-title">
		    		<h2 class="mdl-card__title-text">3... 2... 1... Liftoff!</h2>
		  		</div>
				<div class="mdl-card__supporting-text">
				    <p>
				    	That's it folks! We've entered the alpha stage of the website!
				    	During the  coming months we'll be testing out the website and improving it where possible.
				    	For that process to be efficient, you're our most important asset!
				    	Test our website and send us any bugs/improvements you may find.
				    </p>
				    <p>Stay updated with the developement on GitHub <a href="https://github.com/ArnaudWeyts/showtime" class="no-linkstyle">here</a>!</p>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
@endsection