<?php

namespace App\Console\Commands;

use App\Mail\WebsiteSubscription;
use App\Models\User;
use App\Models\Newsletter;
use App\Models\Website;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailToSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriber:emails {website*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to subscribers about some content';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $websiteId = $this->argument('website')[0];
        $website = Website::find($websiteId);

        if ($website) {
            // Get all subscribers from a website_id
            $subscribers = Newsletter::where('website_id', 1)->where('is_mail_sent', false)->with('user', 'website')->get();

            // send email to subscribers
            foreach ($subscribers as $subscriber) {
                $this->sendEmailToSubscribers($subscriber->website->id, $subscriber->user->id);
            }
            echo 'Emails successfully sent';
        } else {
            echo 'Website does not exist';
        }
    }

    private function sendEmailToSubscribers($websiteId, $userId)
    {
        $user = User::find($userId);

        Mail::to($user)->send(new WebsiteSubscription());

        $newsletter = Newsletter::where('website_id', $websiteId)->where('user_id', $userId)->first();
        $newsletter->is_mail_sent = true;
        $newsletter->save();
    }
}
