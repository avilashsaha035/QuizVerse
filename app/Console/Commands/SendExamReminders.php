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

            $activeExams = Exam::where('is_active', true)
                ->whereNotNull('start_date')
                ->whereNotNull('start_time')
                ->get();

            $upcomingExams = $activeExams->filter(function (Exam $exam) use ($now, $oneHourLater) {
                $startsAt = Carbon::parse("{$exam->start_date} {$exam->start_time}");
                return $startsAt->greaterThan($now) && $startsAt->lessThanOrEqualTo($oneHourLater);
            });

            $totalEmailsSent = 0;

            foreach ($upcomingExams as $exam) {
                $examStart = Carbon::parse("{$exam->start_date} {$exam->start_time}");
                $this->info("Exam '{$exam->title}' starts at {$examStart->format('Y-m-d H:i:s')}");

                $participants = User::whereHas('participant')
                    ->pluck('id');

                if ($participants->isEmpty()) {
                    $participants = User::whereNotNull('email')->pluck('id');
                }

                foreach ($participants->unique() as $userId) {
                    $user = User::find($userId);
                    if ($user && $user->email) {
                        SendExamReminderEmail::dispatch($exam, $user)->onQueue('default');
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
