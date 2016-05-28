@extends('layouts.master')
@section('title','Edit a review')
@section('headlinks')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		var textarea = ".addreview-content--extended__textarea";
		document.addEventListener('mdl-componentupgraded', function(e) {
		//In case other element are upgraded before the layout
			if (typeof e.target.MaterialLayout !== 'undefined') {
				tinymce.init({
					selector: textarea,
					body_class: 'fullreview-content',
					plugins: "image link",
					height: 400,
					style_formats: [
    					{title: 'Heading 1', format: 'h1'},
					    {title: 'Heading 2', format: 'h2'},
					    {title: 'Regular text', format: 'p'}
   					],
   					toolbar: 'undo redo | styleselect removeformat | bold italic underline strikethrough | alignleft aligncenter alignright alighnjustify | bullist numlist outdent indent | link image',
					setup: function(ed) {
				        ed.on('init', function(e) {
				        	if (!document.getElementById('extended').checked) {
				        		e.target.hide();
				        	}
				        });
    				}
				});
			}
		});
	</script>
@endsection
@section('content')
	<style type="text/css">
		.content-contain {
			min-height: 100%;
		}
		.addreview-form {
			margin: 1rem;
		}
		.addreview-content {
			width: 100%;
		}
		.addreview-content--extended {
			margin: 1rem 0;
		}
		.addreview-content--extended__textarea {
			display: none;
		}
		.addreview-rating {
			margin-top: 1rem;
		}
		.formslider {
			margin: 2rem 0;
			width: 20rem;
		}
		.formbutton {
			margin-bottom: 1rem;
		}
		.formbutton-back {
			float: left;
		}
		.formbutton-submit {
			float: right;
		}
		.footerfiller {
			height: 100%;
		}
		.remainingchars {
			font-size: 12px;
			float: right;
		}
	</style>
	<div class="content-contain">
		<p class="breadcrumb">
			<a href="{{ url('/')}}" class="no-linkstyle">Home</a>
			<i class="material-icons align-icon">chevron_right</i>
			<a href="{{ url('/shows') }}" class="no-linkstyle">Shows</a>
			<i class="material-icons align-icon">chevron_right</i>
			<a href="{{ url('/shows') . '/' . $show->id }}" class="no-linkstyle">{{ $show->title }}</a>
			<i class="material-icons align-icon">chevron_right</i>
			Edit your review
		</p>
		<form class="addreview-form" action="edit" method="post">
			{!! csrf_field() !!}
			<div class="mdl-textfield mdl-js-textfield">
			    <input class="mdl-textfield__input" name="title" type="text" id="title" value="{{ $review->title }}" maxlength="70">
			    <label class="mdl-textfield__label" for="title">Enter a title here...</label>
			    @if ($errors->has('title'))
					<span class="{{ $errors->has('title') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('title') }}
					</span>
				@endif
  			</div>

			<div class="mdl-textfield mdl-js-textfield addreview-content">
			    <textarea class="mdl-textfield__input" name="shortcontent" type="text" rows= "6" id="shortcontent" maxlength="200">{{ $review->shortcontent }}</textarea>
			    <label class="mdl-textfield__label" for="shortcontent">Enter a summary about your review here...</label>
			    @if ($errors->has('shortcontent'))
					<span class="{{ $errors->has('shortcontent') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('shortcontent') }}
					</span>
				@endif
				<div id="remainingchars" class="remainingchars"></div>
		    </div>

		    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="extended">
				<input name="extended" type="checkbox" id="extended" class="mdl-checkbox__input" value="extended" @if($review->content!=null) checked @endif>
				<span class="mdl-checkbox__label">Extended review</span>
			</label>

		    <div class="addreview-content--extended">
			    <textarea name="content" type="text" class="addreview-content--extended__textarea">{{ $review->content }}</textarea>
			    @if ($errors->has('content'))
					<span id="content-error" class="{{ $errors->has('content') ? 'mdl-textfield__error' : '' }}">
						{{ $errors->first('content') }}
					</span>
				@endif
			</div>

			<label for="rating">Rating</label>
		 	<p class="formslider">
		 		<input class="mdl-slider mdl-js-slider" name="rating" type="range" min="0" max="10" value="{{ $review->rating }}" tabindex="0" id="rating">
		 	</p>
		 	<div id="formslider_stars" class="rating addreview-stars">
				@for($i = 0; $i < 5; $i++)
					<i class="material-icons">star_border</i>
				@endfor
		 	</div>
			<a href="{{ url('/dashboard') }}" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect no-linkstyle formbutton formbutton-back">Go back</a>
			<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent formbutton formbutton-submit">Submit</button>
		</form>
	</div>
@endsection
@section('JS')
<script>
	var text_max = 200;
	var remainingchars = document.getElementById('remainingchars');
	var shortcontent = document.getElementById('shortcontent');
	remainingchars.innerHTML = text_max - shortcontent.value.length + ' characters remaining';
	shortcontent.addEventListener('keyup', function() {
        var text_length = shortcontent.value.length;
        var text_remaining = text_max - text_length;

        remainingchars.innerHTML = text_remaining + ' characters remaining';
    });
	var extended = document.getElementById('extended')
	extended.addEventListener('change', function() {
		if (extended.checked) {
			tinymce.editors[0].show();
			// hide show error when toggle
			@if ($errors->has('content'))
				document.getElementById('content-error').style.display = 'block';
			@endif
		}
		else {
			tinymce.editors[0].hide();
			// hide show error when toggle
			@if ($errors->has('content'))
				document.getElementById('content-error').style.display = 'none';
			@endif
		}
	});
	var slider = document.getElementById('rating');
	var stars = document.getElementById('formslider_stars');
	/* Sets the right amount of stars for rating */
	slider.addEventListener("input", function(){
		updateSlider(slider, stars);
	});
	var updateSlider = function(slider, stars) {
		var rating = slider.value;
		stars.innerHTML = '';
		for (var i = 0; i < Math.floor(rating / 2); i++) {
			currentstars = stars.innerHTML;
			stars.innerHTML = currentstars + '<i class="material-icons">star</i>';
		}
		if (rating % 2 !== 0) {
			currentstars = stars.innerHTML;
			stars.innerHTML = currentstars + '<i class="material-icons">star_half</i>';
		}
		for (i = 0; i < (rating % 2 === 0 ? 5 : 4 ) - Math.floor(rating / 2); i++) {
			currentstars = stars.innerHTML;
			stars.innerHTML = currentstars + '<i class="material-icons">star_border</i>';
		}
	}
	updateSlider(slider, stars);
</script>
@endsection