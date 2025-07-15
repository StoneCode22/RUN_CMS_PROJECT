<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComplaintReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function build()
    {
        return $this->subject('Your Complaint Has Been Received')
                    ->view('emails.complaint_received');
    }
}
