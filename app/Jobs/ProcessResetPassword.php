<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class ProcessResetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The user.
     * @var \Illuminate\Contracts\Auth\Authenticatable $user
     */
    protected $user;

    /**
     * Process the resetting user's password
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function __construct($user)
    {
    	$this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	Mail::to('AkkarachaiWangcharoensap@gmail.com')->send(new ResetPasswordMail($this->user));
        //
    }
}
