<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetEmail extends Mailable
{
    use Queueable, SerializesModels;
public $MailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct($MailData)
    {
      $this->MailData = $MailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from($this->MailData->sendermail)
                    ->subject($this->MailData->subject)
                    ->view('mailtemplates.html_password_reset_mail_template')
                    ->with('MailData',$this->MailData);
    }
}
