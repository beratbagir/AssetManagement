<?php

namespace App\Console\Commands;
use App\Mail\LicenceExpiryReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Licence;
use Illuminate\Console\Command;

class SendLicenceExpiryReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'licences:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for licences expiring within a week.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneWeekFromNow = Carbon::now()->addWeek()->format('Y-m-d');

        $expiringLicences = Licence::whereDate('expiration_date', '<=', $oneWeekFromNow)->get();

        if ($expiringLicences->isEmpty()) {
            $this->info('No licences expiring within a week.');
            return;
        }
        
        $mailtrapTestEmails = User::all()->pluck('email')->toArray();


        foreach ($mailtrapTestEmails as $email) {
            Mail::to($email)->queue(new LicenceExpiryReminderMail($expiringLicences));
        }
    $this->info('Licence expiry reminder emails have been sent.');
}

    
}
