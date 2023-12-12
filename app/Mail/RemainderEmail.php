<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemainderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*$address = 'jerinmonish007@gmail.com';
        $to = 'jerinmonish@boscoits.com';
        $subject = 'This is a demo!';
        $name = 'Jane Doe';*/
        return $this->view('mails.remgmail')
                    ->from('crinational@gmail.com', 'Reminder To Vote - National CRI Election Desk')
                    //->cc($address, $name)
                    //->bcc($address, $name)
                    //->replyTo($to, $name)
                    ->subject($this->data['subject'])
                    ->with(['mdata' => $this->data]);
    }
}
