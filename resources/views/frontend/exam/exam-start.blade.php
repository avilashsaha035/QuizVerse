@extends('layouts.app')

@push('frontend_title')
    Exam Page
@endpush

@section('content')
    <div class="max-w-4xl mx-auto py-12">
        @livewire('exam-page', ['examId' => $exam->id])
    </div>
@endsection
