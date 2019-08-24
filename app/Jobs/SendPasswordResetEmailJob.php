<?php

namespace App\Jobs;

use App\Helpers;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $code;
    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $resetLink = Config::get('email.default.password_reset_link');
        $resetLink = $resetLink . '/' . $this->code;

        $data = [
            'full_name' => Helpers::getFullName($this->user->first_name, $this->user->last_name),
            'reset_code' => $this->code,
            'reset_link' => $resetLink
        ];

        $emailHeaders = [
            'email' => $this->user->email,
            'full_name' => Helpers::getFullName($this->user->first_name, $this->user->last_name),
        ];

        Mail::send('emails.password_reset', $data, function ($message) use ($emailHeaders) {
            $message->to($emailHeaders['email'], $emailHeaders['full_name'])->subject('Password Reset Link!');
        });
    }
}
