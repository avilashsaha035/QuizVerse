@extends('layouts.app')

@push('frontend_title')
    Exam Result
@endpush

@section('content')
    <div class="max-w-4xl mx-auto bg-amber-50 mt-8 p-6 rounded-xl shadow">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-4"><i class="fa-solid fa-ranking-star"></i> {{ $exam->title }} - Result </h1>
            <p class="text-lg text-gray-700 mb-2"><i class="fa-solid fa-star"></i> Your Score: <span class="font-semibold">{{ $attempt->score }}</span></p>
            <p class="text-lg mb-4">
                @if($attempt->score >= $exam->pass_marks)
                    <span class="text-emerald-600 font-bold"><i class="fa-solid fa-face-grin-wide"></i> Passed</span>
                @else
                    <span class="text-red-600 font-bold"><i class="fa-solid fa-face-frown"></i> Failed</span>
                @endif
            </p>
        </div>
        <hr>

        <div>
            <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-3"><i class="fa-solid fa-magnifying-glass"></i> Answer Review</h2>
            <div class="space-y-4">
                @foreach($exam->questions as $key => $question)
                    @php
                        $userAnswer = $userAnswers[$question->id] ?? null;
                        $correctOption = $question->options->where('is_correct', '1')->first();
                    @endphp

                    <div class="bg-gray-50 p-4 border rounded-lg">
                        <p class="font-medium text-gray-800 @if($userAnswer && $userAnswer->selected_option_id === null) text-red-400 @endif">
                            <strong>{{ $key + 1 }}.</strong> {{ $question->question_text }}
                        </p>

                        @foreach($question->options as $option)
                            <div class="ml-4">
                                <span class="
                                    @if($option->id == $correctOption->id) text-emerald-600 font-semibold @endif
                                    @if($userAnswer && $option->id == $userAnswer->selected_option_id && !$userAnswer->is_correct) text-red-600 font-semibold @endif
                                ">
                                    {{ $option->option_text }}
                                </span>

                                @if($option->id == $correctOption->id)
                                    <span class="ml-2 text-emerald-600">✅</span>
                                @endif

                                @if ($userAnswer && $option->id == $userAnswer->selected_option_id && !$userAnswer->is_correct)
                                    <span class="ml-2 text-emerald-600">❌</span>
                                @endif
                            </div>
                        @endforeach

                        <p class="font-medium text-blue-600">
                            <strong>Explanation:</strong> {{ $question->explanation?->explanation_text }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- <a href="{{ route('exam', $exam->id) }}" class="mt-6 inline-block px-4 py-2 bg-emerald-600 text-white rounded-lg"> <i class="fa-solid fa-arrow-rotate-left"></i> Retake Exam</a> --}}
    </div>
@endsection
