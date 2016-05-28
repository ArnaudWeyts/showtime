@extends('layouts.master')
@section('title', $user->username)
@section('content')
	<style>
		.flexbox-container {
			display: flex;
			flex-direction: row;
			flex-wrap: wrap;
			justify-content: flex-start;
			align-content: flex-start;
			align-items: flex-start;
		}
		.breadcrumb {
			width: 100%;
		}
		.user-card {
			margin: 1rem auto;
			flex-grow: 0;
			width: 50%;
			flex-basis: 50%;
		}
		@media(max-width: 70rem) {
			.user-card {
				margin: 1rem;
				flex-grow: 1;
				width: 100%;
				flex-basis: 100%;
			}
		}
	</style>
	<div class="content-contain">
		<div class="flexbox-container">
			<p class="breadcrumb">
				<a href="{{ url('/')}}" class="no-linkstyle">Home</a>
				<i class="material-icons align-icon">chevron_right</i>
				<a href="{{ url('/users') }}" class="no-linkstyle">Users</a>
				<i class="material-icons align-icon">chevron_right</i>
				{{ $user->username }}
			</p>
			<div class="user-card mdl-card mdl-shadow--2dp">
				<div class="mdl-card__title">
					<h2 class="mdl-card__title-text">{{ $user->username }}&nbsp;
						@if ($user->type == 'verified')
							<i class="material-icons align-icon verified-icon" id="verifiedUserTag">verified_user</i>
							<div class="mdl-tooltip mdl-tooltip--right" for="verifiedUserTag">
								This user has been verified
							</div>
						@elseif ($user->type == 'mod')
							<i class="material-icons align-icon mod-icon" id="modUserTag">assistant</i>
							<div class="mdl-tooltip mdl-tooltip--right" for="modUserTag">
								This user is a moderator
							</div>
						@elseif ($user->type == 'admin')
							<i class="material-icons align-icon admin-icon" id="adminUserTag">builder</i>
							<div class="mdl-tooltip mdl-tooltip--right" for="adminUserTag">
								This user is an admin
							</div>
						@endif
					</h2>
					@if($user->firstname)
						<h3 class="mdl-card__subtitle-text">{{ $user->firstname}} {{ $user->lastname }}</h3>
					@endif
				</div>
				<div class="mdl-card__supporting-text">
					<section class="user-info">
						<dl>
							<dt><i class="material-icons align-icon">thumbs_up_down</i> Karma</dt>
							@if( $user->karma >= 0)
								<dd class="user-karma__positive">
							@else
								<dd class="user-karma__negative">
							@endif
									{{ $user->karma }}
								</dd>
							<dt><i class="material-icons align-icon">location_on</i> Location</dt>
							<dd>
								@if($user->location)
									{{ $user->location }}
								@else
									No location provided
								@endif
							</dd>
							<dt><i class="material-icons align-icon">timeline</i> Member since</dt>
							<dd>
								{{ $user->created_at->toDateString() }}
							</dd>
						</dl>
					</section>
					<section class="user-bio">
						<h4>Bio</h4>
						@if($user->bio)
							{!! nl2br(e($user->bio)) !!}
						@else
							No bio provided <i class="material-icons align-icon">sentiment_dissatisfied</i>
						@endif
					</section>
				</div>
				<div class="mdl-card__actions mdl-card--border">
				    <a href="{{ @url('users') . '/' . $user->id . '/reviews' }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				      View reviews
				    </a>
				</div>
				@if(!Auth::guest() && Auth::user()->id == $user->id)
					<div class="mdl-card__menu">
						<a href="{{ url('/users') . '/' . $user->id . '/edit'}}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" id="editProfileButton">
							<i class="material-icons">edit</i>
						</a>
						<div class="mdl-tooltip mdl-tooltip--left mdl-tooltip--large" for="editProfileButton">
							Edit your profile
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection