@extends('layouts.master')
@section('title', 'Choose a show')
@section('content')
<style>
	.choose-show-form {
		margin: 1rem;
	}
	.choose-show-form__buttons {
		margin: 1rem 0;
	}
</style>
<div class="content-contain">
	<form action="choose" method="post" class="choose-show-form">
		<select name="show">
			@foreach($shows as $show)
				<option value="{{ $show->id }}">{{ $show->title }}</option>
			@endforeach
		</select>
		{!! csrf_field() !!}
		<div class="choose-show-form__buttons">
			<a href="{{ url('/reviews') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect no-linkstyle choose-show-back">Go back</a>
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent choose-show-submit">Continue</button>
		</div>
	</form>
</div>
@endsection