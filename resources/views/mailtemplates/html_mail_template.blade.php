<b>Hello <i>{{ $MailData->receiver }}</i></b>,
<p><b>I hope you’re well. Please see attached {{ $MailData->doctype.' N0-'.$MailData->id }} for  {{ $MailData->projectname }}.</b></p>
  
<div>
<p><b>Don’t hesitate to reach out if you have any questions.</b></p>
<p><b>Thank You.</b></p>
</div>
  
  
<div>
<p><b>for more details visit,</b></p>
<p><b><a href="{{ url()->current() }}">{{ url()->current() }}</a></b></p>
</div>
  
<b>Kind regards,</b>
<br/>
<b><i>{{ $MailData->sender }}.</i></b>
