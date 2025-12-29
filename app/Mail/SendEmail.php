<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/*
In this section, we'll create the mailable class, which will be used to send emails. The mailable class is responsible for sending emails using a mailer that's configured in the config/mail.php file. In fact, Laravel already provides an artisan command that allows us to create a base template.
*/

class SendEmail extends Mailable
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


    /**
     * Build the message.
     *
     * @return $this
     */
   public function build()
    {
     

 return $this->from($this->MailData->sendermail, $this->MailData->sender)
                    ->subject($this->MailData->subject)
                    ->view('mailtemplates.html_mail_template')
                    //->cc(['megaluno23@gmail.com','info@gmail.com'])
                    ->with('MailData',$this->MailData);


    }
}
