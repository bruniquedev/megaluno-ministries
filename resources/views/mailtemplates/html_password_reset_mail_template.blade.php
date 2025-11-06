<h1>You requested for a password reset</h1>
<p><b>You can reset your password from below link:</b></p>
<b><a href="{{ route('resetpasswordform.get', $MailData->token) }}">Reset Password</a><b>
<b><i>If it wasn't you please let us know.</i></b>
<b><i>{{ $MailData->sender }}.</i></b>
