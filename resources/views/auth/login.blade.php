@extends('layouts.master')
@section('title', 'Login')
@section('content')
<style type="text/css">
	.form-card {
		text-align: center;
		margin: 2rem auto;
	}
	.center {
		text-align: center;
	}
	.remember-checkbox {
		text-align: left;
		margin-left: 15px;
		margin-bottom: 1rem;
	}
	.align-icon {
		vertical-align: middle;
		margin-left: 2rem;
	}
</style>
<div class="mdl-card mdl-shadow--2dp form-card">
	<div class="mdl-card__title">
		<h2 class="mdl-card__title-text">Log in to your account</h2>
	</div>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
		{!! csrf_field() !!}

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="email" type="email" id="email" value="{{ old('email') }}">
				<label class="mdl-textfield__label" for="email">Email</label>
				@if ($errors->has('email'))
				<span class="{{ $errors->has('email') ? 'mdl-textfield__error' : '' }}">
					{{ $errors->first('email') }}
				</span>
				@endif
			</div>
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<div class="mdl-textfield mdl-js-textfield">
				<input class="mdl-textfield__input form-control" name="password" type="password" id="password" value="{{ old('password') }}">
				<label class="mdl-textfield__label" for="password">Password</label>
				@if ($errors->has('password'))
				<span class="{{ $errors->has('password') ? 'mdl-textfield__error' : '' }}">
					{{ $errors->first('password') }}
				</span>
				@endif
			</div>
		</div>

		<div class="form-group">
			<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect remember-checkbox" for="checkbox-1">
				<input type="checkbox" id="checkbox-1" class="mdl-checkbox__input" name="remember">
				<span class="mdl-checkbox__label">Remember me</span>
			</label>

		</div>

		<div class="form-group">
			<div class="mdl-card__actions mdl-card--border">
				<button type='submit' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					Login
				</button>
			</div>
		</div>
	</form>
</div>
<div class="center">
	<!-- Large Tooltip -->
	<a class="reset-link" href="{{ url('/password/reset') }}">
		<div id="reset" class="icon material-icons">help</div>
		<div class="mdl-tooltip mdl-tooltip--large" for="reset">
			Forgot your password?
		</div>
	</a>
</div>
@endsection
