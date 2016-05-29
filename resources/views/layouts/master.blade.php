<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		@yield('title') &middot; Showtime
	</title>
	<link rel="stylesheet" href="{{ asset('css/material.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<script src="{{ asset('js/material.min.js') }}"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	@yield('headlinks')
</head>
<body>
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header header">
			<div class="mdl-layout__header-row">
		     	<span class="mdl-layout-title"><a href="/" class="no-linkstyle headerlogo">Showtime</a></span>
		     	<div class="mdl-layout-spacer">
		     	</div>
			    <nav class="mdl-navigation mdl-layout--large-screen-only">
			        <a class="mdl-navigation__link mdl-navigation__link active-nav" href="{{ url('/') }}">Home</a>
			        <a class="mdl-navigation__link" href="{{ url('/shows') }}">Explore shows</a>
			        <a class="mdl-navigation__link" href="{{ url('/reviews') }}">Explore reviews</a>
			        <a class="mdl-navigation__link" href="{{ url('/register') }}">Get involved</a>
			     </nav>
			     <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right searchfield" id="searchfield">
			     	<form action="{{ url('/search') }}" method="GET" id="searchform">
        				<label class="mdl-button mdl-js-button mdl-button--icon searchiconlabel" for="show">
          					<i class="material-icons">search</i>
        				</label>
		        		<div class="mdl-textfield__expandable-holder">
		          			<input class="mdl-textfield__input searchinput" type="text" name="s" id="show" placeholder="Enter a show">
		        		</div>
		        	</form>
		        </div>
		        @if (!Auth::guest())
					<a href="{{ url('/users') . '/' . Auth::user()->id }}" class="no-linkstyle header-accountname">{{ Auth::user()->username }}</a>
		        @endif
		        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
  					<i class="material-icons">account_circle</i>
				</button>
				<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect accountmenu" for="demo-menu-lower-right">
					@if (Auth::guest())
						<a class="no-linkstyle" href="{{ url('/login') }}"><li class="mdl-menu__item">Login</li></a>
						<a class="no-linkstyle" href="{{ url('/register') }}"><li class="mdl-menu__item">Register</li></a>
					@else
						<a class="no-linkstyle" href="{{ url('/dashboard') }}"><li class="mdl-menu__item">My Dashboard</li></a>
						<!--<a class="no-linkstyle" href="{{ url('/dashboard') }}"><li class="mdl-menu__item">Settings</li></a>-->
						<a class="no-linkstyle" href="{{ url('/logout') }}"><li class="mdl-menu__item">Logout</li></a>
					@endif
				</ul>
		    </div>
		</header>
		<div class="mdl-layout__drawer">
	    	<span class="mdl-layout-title">Showtime</span>
	    	<nav class="mdl-navigation">
		      <a class="mdl-navigation__link mdl-navigation__link active-nav" href="{{@url('/')}}">Home</a>
		      <a class="mdl-navigation__link" href="{{@url('/shows')}}">Explore shows</a>
			  <a class="mdl-navigation__link" href="{{@url('/reviews')}}">Explore reviews</a>
		      <a class="mdl-navigation__link" href="{{@url('/register')}}">Get involved</a>
	    	</nav>
	  	</div>
		<main class="mdl-layout__content">
			<div class="content">
				@yield('content')
			</div>
			<div class="mdl-layout-spacer"></div>
			<footer class="mdl-mini-footer footer">
	  			<div class="mdl-mini-footer__left-section">
		    		<div class="mdl-logo">Showtime</div>
				    <ul class="mdl-mini-footer__link-list">
				      <li><a href="#">Help</a></li>
				      <li><a href="#">Privacy &amp; Terms</a></li>
				    </ul>
	  			</div>
		 	</footer>
	  	</main>
	</div>
</body>
@yield('JS')
</html>