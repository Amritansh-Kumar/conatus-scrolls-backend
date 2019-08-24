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

        $resetLink = env('APP_DASHBOARD_URL') . '/auth/reset-password';
        $resetLink = $resetLink . '?' . http_build_query([
                'email' => $this->user->email,
                'token' => $this->code
            ]);

        $emailHeaders = [
            'email'     => $this->user->email,
            'full_name' => Helpers::getFullName($this->user->first_name, $this->user->last_name),
        ];

        $body = "Use this link to reset your password \n " . $resetLink;

        Mail::send([], [], function ($message) use ($emailHeaders, $body) {

            $message->to($emailHeaders['email'], $emailHeaders['full_name'])
                ->subject('Password Reset Link!')
                ->setBody($body);
        });
    }
}
