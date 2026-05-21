@extends('layouts.app')

@push('frontend_title')
    Exams
@endpush

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>

@section('content')
    <div class="py-8 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-gray-200">
                            Available <span class="bg-gradient-to-r from-blue-600 to-emerald-500 bg-clip-text text-transparent">Exams</span>
                        </h1>
                        <p class="text-gray-600  mt-2 text-sm md:text-base">
                            Test your knowledge with our curated MCQ exams
                        </p>
                    </div>

                    <!-- Search and Filters -->
                    <div class="mt-4 sm:mt-0 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <!-- Search Box -->
                        <div class="relative">
                            <input type="text"
                                   placeholder="Search exams..."
                                   class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none dark:bg-gray-700 dark:text-white text-sm w-full sm:w-64"
                                   id="examSearch">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>

                        <!-- Filter Button -->
                        <div class="relative">
                            <button id="filterBtn"
                                    class="flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 text-sm">
                                <i class="fas fa-filter mr-2"></i>
                                Filter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Bar -->
                <div class="mt-6 flex flex-wrap items-center gap-4 text-sm">
                    <div class="flex items-center text-gray-600 ">
                        <i class="fas fa-layer-group mr-2 text-blue-500"></i>
                        <span>Showing <span class="font-semibold text-gray-800 dark:text-gray-200">{{ count($exams) }}</span> exams</span>
                    </div>
                    <div class="flex items-center text-gray-600 ">
                        <i class="fas fa-clock mr-2 text-emerald-500"></i>
                        <span>Avg. duration: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ round($exams->avg('duration_minutes')) }} min</span></span>
                    </div>
                    <div class="flex items-center text-gray-600 ">
                        <i class="fas fa-star mr-2 text-amber-500"></i>
                        <span>Popular: <span class="font-semibold text-gray-800 dark:text-gray-200">{{ strtoupper($exams->max('exam_type')) }}</span></span>
                    </div>
                </div>
            </div>

            @if ($exams->isEmpty())
                <div id="noExamsMessage" class="text-center py-12">
                    <div class="max-w-md mx-auto">
                        <i class="fas fa-search text-4xl text-gray-400 mb-4"></i>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">No exams found</h3>
                        <p class="text-gray-600 ">Try adjusting your search or filter criteria.</p>
                    </div>
                </div>
            @else
                <!-- Exams Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                    <!-- Exam Card -->
                    @foreach ($exams as $exam)
                        @php
                            $attempts_used = $exam->attempts->count();
                            $remaining_attempts = $exam->attempts_allowed - $attempts_used;
                        @endphp
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 card-hover group">
                            <a href="#">
                                <img class="rounded-t-base object-cover" src="{{ $exam->thumbnail ? asset('storage/exam_thumbnails/' . $exam->thumbnail) : asset('images/default-exam.png') }}" alt="thumbnail" />
                            </a>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                                    {{ $exam->title }}
                                </h3>

                                <div class="space-y-1 mb-2">
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <div>
                                            <i class="fas fa-question-circle mr-1 text-blue-500 w-5"></i>
                                            <span>{{ $exam->no_of_ques }} MCQ</span>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-600">
                                            {{ strtoupper($exam->exam_type) }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="flex items-center text-sm text-gray-600 ">
                                            <i class="fas fa-clock mr-1 text-emerald-500 w-5"></i>
                                            <span>{{ $exam->duration_minutes }} minutes</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600 ">
                                            <i class="fas fa-trophy mr-1 text-amber-500 w-5"></i>
                                            <span>Pass Mark: {{ $exam->pass_marks }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between">
                                    <div class="flex items-center">
                                        @if (!auth()->check() || $remaining_attempts > 0)
                                            @if ($exam->is_active_now)
                                                {{-- Exam is currently active --}}
                                                <a href="{{ route('exam.rules', $exam->id) }}"
                                                    class="py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all duration-200 text-sm flex items-center justify-center min-w-[110px] hover:-translate-y-0.5 active:translate-y-0">
                                                    <i class="fas fa-play text-sm mr-1"></i>
                                                    <span class="whitespace-nowrap">Start Exam</span>
                                                </a>
                                            @elseif (!$exam->has_started)
                                                {{-- Exam hasn't started yet --}}
                                                <p class="text-gray-600 text-sm">
                                                    <i class="fa-solid fa-bullhorn text-red-600 mr-2"></i>
                                                    Starts from: {{ $exam->formatted_start_date }}
                                                </p>
                                            @else
                                                {{-- Exam has ended --}}
                                                <p class="text-red-400 text-sm p-2">
                                                    <i class="fa-solid fa-ban"></i> Exam has ended
                                                </p>
                                            @endif
                                        @else
                                            {{-- No attempts remaining --}}
                                            <p class="text-red-400 text-sm p-2">
                                                <i class="fa-solid fa-ban"></i> No Attempts Available!!
                                            </p>
                                        @endif
                                    </div>

                                    <div class="flex items-center">
                                        @if (auth()->check())
                                            @if (($examStarted && !$examEnded) && $remaining_attempts != 0)
                                                <p class="text-xs font-semibold text-amber-500"><i class="fa-solid fa-clock-rotate-left fa-flip-horizontal mr-1"></i> {{ $remaining_attempts }} Attempts Remaining</p>
                                            @elseif ($exam->lastAttempt)
                                                <a href="{{ route('exam.result', $exam->id) }}" class="text-gray-600"> <i class="fa-solid fa-square-poll-vertical text-blue-600 mr-1"></i> see result</a>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <!-- Additional info -->
                                <div class="mt-3 pt-2 border-t border-gray-100">
                                    <div class="flex items-center justify-between text-xs text-gray-500 ">
                                        <div class="flex items-center">
                                            <i class="fas fa-users mr-1"></i>
                                            <span>1.2k attempts</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $exams->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
