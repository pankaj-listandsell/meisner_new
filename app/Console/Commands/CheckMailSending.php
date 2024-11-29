<?php

namespace App\Console\Commands;


use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\ResetPasswordToken;


class CheckMailSending extends Command
{
    protected $signature = 'mail:check';


    protected $description = 'Check mail working or not';

    public function handle()
    {
        try {
            Mail::raw('Hi, welcome user!', function ($message) {
                $message->to('crystal.dhana@gmail.com')->subject('TESTING');
            });
        } catch (\Exception $exception) {
            dd($exception);
        }

        $this->info('Mail sent successfully');
    }
}
