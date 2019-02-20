<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\SendMail as SendMail;
use Mail;

class EmailSendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $to;
    protected $title;
    protected $sendmail;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to,$title, $sendmail)
    {
        //
        $this->to = $to;
        $this->title = $title;
        $this->sendmail = $sendmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new SendMail($this->title,$this->sendmail);
        Mail::to($this->to)->send($email);
    }
}
