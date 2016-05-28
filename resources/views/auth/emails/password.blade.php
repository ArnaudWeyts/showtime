<p>
	Click
		<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">here</a>
	to reset your password.
</p>
<p>
	Or click the link below:
</p>
<p>
	<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">{{ $link }}</a>
</p>
<p>
	If you did not request a password reset, you can safely ignore this message.
</p>
