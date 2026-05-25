<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "APP TIMEZONE: " . config('app.timezone') . PHP_EOL;
echo "NOW: " . now()->format('Y-m-d H:i:s') . PHP_EOL;

echo PHP_EOL . "--- Exam records ---" . PHP_EOL;
$exams = App\Models\Exam::whereNotNull('start_date')
    ->whereNotNull('start_time')
    ->orderBy('start_date', 'asc')
    ->orderBy('start_time', 'asc')
    ->take(20)
    ->get();

foreach ($exams as $exam) {
    $startsAt = \Carbon\Carbon::parse($exam->start_date . ' ' . $exam->start_time);
    echo "{$exam->id} | {$exam->title} | {$exam->start_date} {$exam->start_time} | starts_at=" . $startsAt->format('Y-m-d H:i:s') . " | active=" . ($exam->is_active ? 1 : 0) . " | has_started=" . ($exam->has_started ? 1 : 0) . " | has_ended=" . ($exam->has_ended ? 1 : 0) . PHP_EOL;
}

$nextHour = now()->copy()->addHour();
echo PHP_EOL . "Window: " . now()->format('Y-m-d H:i:s') . " -> " . $nextHour->format('Y-m-d H:i:s') . PHP_EOL;

$matched = $exams->filter(function ($exam) {
    $startsAt = \Carbon\Carbon::parse($exam->start_date . ' ' . $exam->start_time);
    return $startsAt->greaterThan(now()) && $startsAt->lessThanOrEqualTo(now()->copy()->addHour());
});

echo PHP_EOL . "Matched exams: " . $matched->count() . PHP_EOL;
foreach ($matched as $exam) {
    $startsAt = \Carbon\Carbon::parse($exam->start_date . ' ' . $exam->start_time);
    echo "MATCH: {$exam->id} | {$exam->title} | starts_at=" . $startsAt->format('Y-m-d H:i:s') . PHP_EOL;
}
