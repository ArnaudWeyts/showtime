@extends('layouts.master')
@section('title', 'Reset your password')
<!-- Main Content -->
@section('content')
<style>
    .form-card {
        text-align: center;
        margin: 2rem auto;
        min-height: 0;
    }
</style>
<div class="mdl-card mdl-shadow--2dp form-card">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Reset your password</h2>
    </div>

    <form role="form" method="POST" action="{{ url('/password/email') }}">
        {!! csrf_field() !!}

        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input form-control" name="email" type="email" id="email" value="{{ old('email') }}">
            <label class="mdl-textfield__label" for="email">Email</label>
            @if ($errors->has('email'))
                <span class="{{ $errors->has('email') ? 'mdl-textfield__error' : '' }}">
                    {{ $errors->first('email') }}
                </span>
            @endif
            @if (session('status'))
                <span class="mdl-textfield__error upvote-color">
                    {{ session('status') }}
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
