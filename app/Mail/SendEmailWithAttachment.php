<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
/*
In this section, we'll create the mailable class, which will be used to send emails. The mailable class is responsible for sending emails using a mailer that's configured in the config/mail.php file. In fact, Laravel already provides an artisan command that allows us to create a base template.
*/
class SendEmailWithAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $MailData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //method is used to initialize objects that you're supposed to use in the email template.
    public function __construct($MailData)
    {
        //
        $this->MailData = $MailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

/*
method is used to initialize more email-specific values like from, view template, and attachments.
In our case, we've passed the $MailData object as a constructor argument, and it's assigned to the MailData public property.
we need to create email templates that we're supposed to use while sending emails. Go ahead and create a file resources/views/mailtemplates/html_mail_template.blade.php as shown in the following snippet.
*/
    public function build()
    {
        return $this->from($this->MailData->billfromemail)
                      ->subject($this->MailData->subject)
                    ->view('mailtemplates.html_mail_template')
                    ->text('mailtemplates.plain_mail_template')
                    ->with('MailData',$this->MailData)
                      ->attach($this->MailData->file_url, [
                              'as' => $this->MailData->filename,
                              'mime' => $this->MailData->filetype,
                      ]);
    }
}
