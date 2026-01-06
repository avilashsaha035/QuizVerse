@extends('layouts.app')

@push('frontend_title')
    Rules & Regulations
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center p-3 bg-emerald-100 rounded-full mt-4 mb-4 w-12 h-12">
                    <i class="fa-solid fa-circle-check fa-xl text-emerald-600"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-2"> Rules & Regulations </h1>
                <p class="text-gray-600 text-2xl"> For <span class="font-semibold text-emerald-600">{{ $exam->title }}</span></p>
            </div>

            <!-- Rules Content Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-100 bg-emerald-500">
                    <div class="flex items-center">
                        <h2 class="text-lg font-semibold text-gray-800">
                            <i class="fa-solid fa-circle-info mr-1"></i>Important Guidelines
                        </h2>
                    </div>
                </div>

                <!-- Rules Content -->
                <div class="p-6 md:p-8">
                    <div class="prose prose-lg max-w-none prose-headings:text-gray-800 prose-p:text-gray-600 prose-ul:text-gray-600 prose-li:my-1">
                        {!! $exam->description !!}
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 border-gray-100 text-sm text-gray-500">
                    <i class="fa-solid fa-clock"></i> Please read all rules carefully before proceeding
                </div>
            </div>

            <!-- Agreement Section -->
            <form action="{{ route('exam.start', $exam->id) }}" method="GET" onsubmit="return validateAgreement()">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 p-6 mb-8">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0 mt-1">
                            <input type="checkbox" id="agreeRules" name="agreeRules" class="h-5 w-5 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500 cursor-pointer"
                                onchange="document.getElementById('startExamBtn').disabled = !this.checked;">
                        </div>

                        <div class="flex-1">
                            <label for="agreeRules" class="block text-gray-700 mb-2 font-medium cursor-pointer">Confirmation & Agreement</label>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">
                                By checking this box, I confirm that I have thoroughly read, understood, and agree to all the rules and regulations for
                                <span class="font-semibold text-emerald-600">{{ $exam->title ?? 'Test Exam 1' }}</span>.
                                I understand that any violation may result in disqualification.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('exam') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-colors duration-200 text-center">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Go Back
                    </a>

                    <button type="submit"
                            class="px-8 py-3.5 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700
                                text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/20
                                disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none
                                transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center"
                            id="startExamBtn" disabled>
                            <span>Start Exam Now <i class="fa-solid fa-arrow-right ml-1"></i></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('frontend_scripts')
   <script>
        $(document).ready(function () {
            const $checkbox = $('#agreeRules');
            const $button   = $('#startExamBtn');

            // Disable button initially
            $button.prop('disabled', true);

            // Toggle button enabled/disabled when checkbox changes
            $checkbox.on('change', function () {
                $button.prop('disabled', !$(this).is(':checked'));
            });

            // Validate on form submit
            $('form').on('submit', function () {
                if (!$checkbox.is(':checked')) {
                    alert('You must agree to the rules before starting the exam.');
                    return false; // prevent submission
                }
            });
        });
    </script>
@endpush


