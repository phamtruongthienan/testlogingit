<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFeedBack extends Mailable
{
    use Queueable, SerializesModels;

    protected $feedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback)
    {
        //
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông báo từ Esearch')->view('theme.frontend.mail.feedback')
        ->with([
            'feedback' => $this->feedback
        ]);
    }
}
