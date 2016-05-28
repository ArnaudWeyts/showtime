@extends('layouts.master')
@section('title', 'Reset your password')
@section('content')
<div class="mdl-card mdl-shadow--2dp form-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Reset your password</h2>
    </div>
    <form  role="form" method="POST" action="{{ url('/password/reset') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input form-control" name="email" type="email" id="email" value="{{ $email or old('email') }}">
            <label class="mdl-textfield__label" for="email">Email</label>
            @if ($errors->has('email'))
                <span class="{{ $errors->has('email') ? 'mdl-textfield__error' : '' }}">
                    {{ $errors->first('email') }}
                </span>
            @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" name="password" type="password" id="password">
            <label class="mdl-textfield__label" for="password">Password</label>
            @if ($errors->has('password'))
                <span class="{{ $errors->has('password') ? 'mdl-textfield__error' : '' }}">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>

        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" name="password_confirmation" type="password" id="password_confirmation">
            <label class="mdl-textfield__label" for="password_confirmation">Confirm password</label>
            @if ($errors->has('password_confirmation'))
                <span class="{{ $errors->has('password_confirmation') ? 'mdl-textfield__error' : '' }}">
                    {{ $errors->first('password_confirmation') }}
                </span>
            @endif
        </div>


        <div class="mdl-card__actions mdl-card--border">
            <button type='submit' class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                Reset
            </button>
        </div>
    </form>
</div>
@endsection
