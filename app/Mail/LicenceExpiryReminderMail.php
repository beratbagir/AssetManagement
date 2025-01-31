<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LicenceExpiryReminderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $licences;
    /**
     * Create a new message instance.
     */
    
    public function __construct($licences)
    {
        $this->licences = $licences;
    }

    public function build()
    {
        return $this->subject('License Expiry Reminder')
                    ->view('licence_reminder')
                    ->with([
                        'licences' => $this->licences,
                    ]);
    }

    /**
     * Get the message envelope.
     */

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
