@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-12">
        @livewire('exam-page', ['examId' => $exam->id])
    </div>
@endsection
