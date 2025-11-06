Hello {{ $MailData->receiver }},
I hope you’re well. Please see attached {{ $MailData->doctype.' N0-'.$MailData->id }} for  {{ $MailData->projectname }}
  
Don’t hesitate to reach out if you have any questions.
Thank You.

for more details visit,
{{ url()->current() }}

Kind regards,
{{ $MailData->sender }}