<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
  
class SendLinks extends Mailable
{
    use Queueable, SerializesModels;
  
    public $mdata;
  
    /**
     * Create a new message instance.
     */
    public function __construct($mdata)
    {
        $this->mdata = $mdata;
    }
  
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Indian Mission Vicariate',
        );
    }
  
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.loginlink',
        );
    }
  
    /**
     * Get the attachments for the message.
     *
     * @return array

     */
    public function attachments(): array
    {
        return [];
    }
}