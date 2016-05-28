@extends('layouts.master')
@section('title', 'Register')
@section('content')
	<div class="mdl-card mdl-shadow--2dp form-card">
		<div class="mdl-card__title">
			<h2 class="mdl-card__title-text">Make an account</h2>
		</div>
		<form class="form" role="form" method="POST" action="{{ url('/register') }}">
			{!! csrf_field() !!}

			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="username" type="text" id="username" value="{{ old('username') }}">
				<label class="mdl-textfield__label" for="username">Username</label>
				@if ($errors->has('username'))
					<span class="{{ $errors->has('username') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('username') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="email" type="email" id="email" value="{{ old('email') }}">
				<label class="mdl-textfield__label" for="email">Email</label>
				@if ($errors->has('email'))
					<span class="{{ $errors->has('email') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('email') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="password" type="password" id="password" value="{{ old('password') }}">
				<label class="mdl-textfield__label" for="password">Password</label>
				@if ($errors->has('password'))
					<span class="{{ $errors->has('password') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('password') }}
					</span>
				@endif
			</div>

			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="password_confirmation" type="password" id="password_confirmation" value="{{ old('password_confirmation') }}">
				<label class="mdl-textfield__label" for="password_confirmation">Confirm password</label>
				@if ($errors->has('password_confirmation'))
					<span class="{{ $errors->has('password_confirmation') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('password_confirmation') }}
					</span>
				@endif
			</div>

			<div class="mdl-card__actions mdl-card--border">
				<button type='submit' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					Register
				</button>
			</div>
		</form>
	</div>
@endsection
