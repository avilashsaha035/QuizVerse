@extends('layouts.app')

@push('frontend_title')
    Exam Result
@endpush

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $exam->title }} - Result</h1>

        <p class="text-lg text-gray-700 mb-2">
            Your Score: <span class="font-semibold">{{ $attempt->score }}</span>
        </p>

        <p class="text-lg mb-4">
            @if($attempt->score >= $exam->pass_marks)
                <span class="text-emerald-600 font-bold">✅ Passed</span>
            @else
                <span class="text-red-600 font-bold">❌ Failed</span>
            @endif
        </p>

        <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Answer Review</h2>
        <div class="space-y-4">
            @foreach($exam->questions as $question)
                @php
                    $userAnswer = $userAnswers[$question->id] ?? null;
                    $correctOption = $question->options->where('is_correct', true)->first();
                @endphp

                <div class="p-4 border rounded-lg">
                    <p class="font-medium text-gray-800">{{ $question->question_text }}</p>

                    @foreach($question->options as $option)
                        <div class="ml-4">
                            <span class="
                                @if($option->id == $correctOption->id) text-emerald-600 font-semibold @endif
                                @if($userAnswer && $option->id == $userAnswer->selected_option_id && !$userAnswer->is_correct) text-red-600 font-semibold @endif
                            ">
                                {{ $option->option_text }}
                            </span>

                            @if($userAnswer && $option->id == $userAnswer->selected_option_id)
                                <span class="ml-2 text-blue-600">(Your choice)</span>
                            @endif

                            @if($option->id == $correctOption->id)
                                <span class="ml-2 text-emerald-600">✅</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <a href="{{ route('exam', $exam->id) }}"
        class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
            Retake Exam
        </a>
    </div>
@endsection
