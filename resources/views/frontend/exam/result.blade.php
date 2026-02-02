@extends('layouts.app')
@push('frontend_title')
    Exam Result
@endpush

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow">
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

        <p class="text-sm text-gray-600 mb-6">
            Percentile: {{ round($attempt->percentile, 2) }}%
        </p>

        <a href="{{ route('exam', $exam->id) }}"
        class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg">
            Retake Exam
        </a>
    </div>
@endsection
