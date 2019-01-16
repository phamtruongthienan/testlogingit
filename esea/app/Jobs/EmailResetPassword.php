<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\ResetPassword as ResetPassword;
use Mail;

class EmailResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $to;
    protected $new_password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to, $new_password)
    {
       $this->to = $to;
       $this->new_password = $new_password;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ResetPassword($this->new_password);
        Mail::to($this->to)->send($email);
        // $to = $this->to;
        // Mail::send(['html' => 'theme.frontend.mail.reset_password'],  array('new_password' => $this->new_password), function ($message) use ($to) {
        //         $message->to($to)->subject('Esearch account password reset');
        // });

    }
}
