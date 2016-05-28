@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<style>
	.dashboard-table {
		width: 100%;
		margin: 1rem;
	}
	.dashboard-table__center {
		text-align: center !important;
	}
	.dashboard-form-delete {
		float: right;
	}
</style>
<div class="content-contain">
	<table class="mdl-data-table mdl-js-data-table dashboard-table">
		<thead>
			<tr>
				<th class="mdl-data-table__cell--non-numeric">Title</th>
				<th class="mdl-data-table__cell--non-numeric">Show</th>
				<th class="mdl-data-table__cell--non-numeric">Created</th>
				<th class="mdl-data-table__cell--non-numeric">Updated</th>
				<th class="dashboard-table__center"><i class="material-icons upvote-color">thumb_up</i></th>
				<th class="dashboard-table__center"><i class="material-icons downvote-color">thumb_down</i></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@forelse($reviews as $review)
				<tr>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{ url('/reviews') . '/' . $review->id }}" class="no-linkstyle">{{ $review->title }}</a>
					</td>
					<td class="mdl-data-table__cell--non-numeric">
						<a href="{{ url('/shows') . '/' . $review->show_id }}" class="no-linkstyle">{{ $review->show_title }}</a>
					</td>
					<td class="mdl-data-table__cell--non-numeric">{{ date('F d, Y H:i', strtotime($review->created_at)) }}</td>
					<td class="mdl-data-table__cell--non-numeric">{{ date('F d, Y H:i', strtotime($review->updated_at)) }}</td>
					<td class="dashboard-table__center">{{ $review->upvotes }}</td>
					<td class="dashboard-table__center">{{ $review->downvotes }}</td>
					<td class="dashboard-action">
						<a href={{ url('/reviews') . '/' . $review->id . '/edit'}} class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
							<i class="material-icons">edit</i>
						</a>
						<form onsubmit="return confirm('Are you sure you want to delete this review?');" class="dashboard-form-delete" method="POST" action="{{ url('/reviews') . '/' . $review->id . '/delete' }}">
							{!! csrf_field() !!}
							<button type="submit" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
	  							<i class="material-icons">delete</i>
							</button>
						</form>
					</td>
				</tr>
			@empty
				<p class="notfound-message">You haven't written any reviews yet!</p>
			@endforelse
		</tbody>
	</table>
</div>
@endsection