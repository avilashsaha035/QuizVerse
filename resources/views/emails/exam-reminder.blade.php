<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
            background-color: white;
        }
        .footer {
            background-color: #f9f9f9;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .exam-details {
            background-color: #e7f3ff;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
            border-radius: 3px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exam Reminder</h1>
        </div>
        <div class="content">
            <p>Hello <strong>{{ $user->name }}</strong>,</p>

            <p>This is a friendly reminder that your exam is starting soon!</p>

            <div class="exam-details">
                <p><strong>Exam:</strong> {{ $exam->title }}</p>
                <p><strong>Start Time:</strong> {{ \Carbon\Carbon::parse($exam->start_date . ' ' . $exam->start_time)->format('F j, Y \a\t g:i A') }}</p>
                <p><strong>Duration:</strong> {{ $exam->duration_minutes }} minutes</p>
                @if($exam->description)
                    <p><strong>Description:</strong> {{ $exam->description }}</p>
                @endif
            </div>

            <p>Please ensure you are in a suitable environment and have a stable internet connection before the exam starts.</p>

            <p>
                <a href="{{ route('exams.show', $exam->slug) }}" class="button">Go to Exam</a>
            </p>

            <p>Good luck with your exam!</p>
        </div>
        <div class="footer">
            <p>&copy; {{ now()->year }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
