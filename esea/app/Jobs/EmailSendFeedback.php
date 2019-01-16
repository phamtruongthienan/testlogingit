<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendFeedBack as SendFeedBack;
use Mail;

class EmailSendFeedback implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $to;
    protected $feedback;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to, $feedback)
    {
        //
        $this->to = $to;
        $this->feedback = $feedback;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new SendFeedBack($this->feedback);
      //  Mail::to($this->to)->send($email);
    }
}
