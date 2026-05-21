<?php

namespace App\Console\Commands;

use App\Jobs\SendExamReminderEmail;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendExamReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exam:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders to users 1 hour before their exam starts';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $now = Carbon::now();
            $oneHourLater = $now->copy()->addHour();

            // Find exams that start between now and 1 hour from now
            $upcomingExams = Exam::where('is_active', true)
                ->whereRaw("CONCAT(start_date, ' ', start_time) > ?", [$now->format('Y-m-d H:i:s')])
                ->whereRaw("CONCAT(start_date, ' ', start_time) <= ?", [$oneHourLater->format('Y-m-d H:i:s')])
                ->get();

            $totalEmailsSent = 0;

            foreach ($upcomingExams as $exam) {
                // Get participants for this exam
                $participants = $exam->attempts()
                    ->selectRaw('DISTINCT user_id')
                    ->pluck('user_id');

                // If no participants found via attempts, try to get from participants table if it exists
                if ($participants->isEmpty()) {
                    $participants = User::whereHas('participant')
                        ->pluck('id');
                }

                foreach ($participants as $userId) {
                    $user = User::find($userId);
                    if ($user && $user->email) {
                        // Dispatch the job to Redis queue
                        SendExamReminderEmail::dispatch($exam, $user)
                            ->onQueue('default');

                        $totalEmailsSent++;
                    }
                }
            }

            if ($totalEmailsSent > 0) {
                $this->info("Successfully dispatched {$totalEmailsSent} exam reminder emails to Redis queue");
                $this->line("Found " . count($upcomingExams) . " exam(s) starting in the next hour");
            } else {
                $this->info('No exams starting in the next hour');
            }

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Error sending exam reminders: " . $e->getMessage());
            return self::FAILURE;
        }
    }
}
