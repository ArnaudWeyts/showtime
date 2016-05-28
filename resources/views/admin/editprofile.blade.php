@extends('layouts.master')
@section('title', 'Edit your profile')
@section('content')
	<div class="mdl-card mdl-shadow--2dp form-card update-profile-card">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Edit your profile</h2>
		</div>
		<form role="form" method="POST" action="edit" class="update-profile-form">
			{!! csrf_field() !!}

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="username" type="text" id="username" value="{{ $user->username }}">
				<label class="mdl-textfield__label" for="username">Username</label>
				@if ($errors->has('username'))
					<span class="{{ $errors->has('username') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('username') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="firstname" type="text" id="firstname" value="{{ $user->firstname }}">
				<label class="mdl-textfield__label" for="firstname">First name</label>
				@if ($errors->has('firstname'))
					<span class="{{ $errors->has('firstname') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('firstname') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="lastname" type="text" id="lastname" value="{{ $user->lastname }}">
				<label class="mdl-textfield__label" for="lastname">Last name</label>
				@if ($errors->has('lastname'))
					<span class="{{ $errors->has('lastname') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('lastname') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" name="location" type="text" id="location" value="{{ $user->location }}">
				<label class="mdl-textfield__label" for="location">Location</label>
				@if ($errors->has('location'))
					<span class="{{ $errors->has('location') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('location') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    			<textarea class="mdl-textfield__input" type="text" rows= "4" id="bio" name="bio">{{ $user->bio }}</textarea>
    			<label class="mdl-textfield__label" for="bio">Bio</label>
  			</div>

			<div class="mdl-card__actions mdl-card--border">
				<button type='submit' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					Apply
				</button>
			</div>
		</form>
	</div>
@endsection