<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class RegistrationMailJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $memberEmails;
    private $memberPasswords;
    private $memberNames;
    private $leader;

    public function __construct($memberEmails, $memberPasswords, $memberNames, User $leader) {

        $this->memberEmails    = $memberEmails;
        $this->memberPasswords = $memberPasswords;
        $this->memberNames     = $memberNames;
        $this->leader          = $leader;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        $message = 'Hi ' . $this->leader->first_name . ' ' . $this->leader->last_name . ' you have successfully 
        registered for Scrolls19. Your teamId is ' . $this->leader->scrolls_id;

        $leader = $this->leader;

        Mail::send([], [], function ($message) use ($leader) {
            $message->to($leader->email)
                ->subject('Scrolls Registration')
                ->setBody('Hi ' . $leader->first_name . ' ' . $leader->last_name . ' you have successfully 
        registered for Scrolls19. Your teamId is ' . $leader->scrolls_id);
        });

//        $this->sendMail($this->leader->email, $message);



        for ($i = 0; $i < count($this->memberEmails); $i++) {

            $memberName     = $this->memberNames[$i];
            $memberEmail    = $this->memberEmails[$i];
            $memberPassword = $this->memberPasswords[$i];

            Mail::send([], [], function ($message) use ($memberEmail, $memberName, $memberPassword) {
                $message->to($memberEmail)
                    ->subject('Scrolls Registration')
                    ->setBody('Hi ' . $memberName . ' your team has been registered for Scrolls19. Your teamId is ' . $this->leader->scrolls_id . ' user this password ' . $memberPassword . ' to register yourself');
            });

//            $message = 'Hi ' . $memberName . ' your team has been registered for Scrolls19. Your teamId is ' . $this->leader->scrolls_id . ' user this password ' . $memberPassword . ' to register yourself';

//            $this->sendMail($memberEmail, $message);

        }
    }

//    public function sendMail($email, $message) {
//        Mail::send([], [], function ($message) use ($email, $message) {
//            $message->to($email)
//                ->subject('Scrolls Registration')
//                ->setBody($message);
//        });
//    }
}
