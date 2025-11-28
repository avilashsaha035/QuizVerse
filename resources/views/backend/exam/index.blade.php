@extends('backend.layouts.app')
@section('content')
@foreach ($exams as $exam)
<h1>{{ $exam->title }}</h1>
    <a href="{{ route('admin.exams.edit', $exam->id) }}">Edit</a>

@endforeach
@endsection
