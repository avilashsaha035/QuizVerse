<div class="min-h-auto bg-gradient-to-br from-gray-50 to-blue-50 p-4 md:p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Exam Header Card -->
        <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 mb-6 md:mb-8 border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="space-y-2">
                    <h1 class="text-xl md:text-3xl font-bold text-gray-800">{{ $exam['title'] }}</h1>
                    <div class="flex flex-wrap gap-4 text-gray-600">
                        <div class="flex items-center gap-1">
                            <i class="fa-regular fa-clock text-blue-500"></i><span class="font-medium">{{ $exam['duration_minutes'] }} minutes</span>
                        </div>
                        <div class="flex items-center gap-1">
                            <i class="fa-regular fa-circle-check text-emerald-500"></i><span class="font-medium">Pass Mark: {{ $exam['pass_marks'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Timer Card -->
                <div wire:poll.1000ms="tick" class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-100 rounded-xl p-2 md:p-4 min-w-[140px]" wire:key="timer">
                    <div class="text-center">
                        <p class="text-xs font-semibold text-red-600 uppercase tracking-wider mb-1"><i class="fa-solid fa-stopwatch fa-xl mr-1"></i>Time Remaining</p>
                        <div class="text-xl md:text-3xl font-bold text-red-600 font-mono">
                            {{ gmdate('i:s', $timeRemaining) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Section -->
        @php
            $answeredCount = collect($answers)->filter(fn($ans) => $ans !== null)->count();
            $progressPercent = ($answeredCount / count($questions)) * 100;
        @endphp
        <div class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <div class="text-sm font-medium text-gray-700">
                    <i class="fa-regular fa-file-lines"></i> Question <span class="font-bold text-emerald-600">{{ $answeredCount }}</span> of <span class="font-bold text-gray-800">{{ count($questions) }}</span>
                </div>
                <div class="text-sm font-medium text-emerald-600">{{ round($progressPercent) }}% Complete</div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div class="bg-gradient-to-r from-purple-500 to-emerald-600 h-2.5 rounded-full transition-all duration-300"style="width: {{ $progressPercent }}%"></div>
            </div>
        </div>

        <!-- Main Exam -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Question Card -->
            <div class="lg:w-2/3">
                @php $q = $questions[$currentIndex]; @endphp
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4 md:p-6 transform transition-all duration-300 hover:shadow-xl h-full" wire:key="question-{{ $q->id }}">
                    <div class="flex items-start mb-2 md:mb-4">
                        <div class="bg-emerald-100 text-emerald-800 font-bold rounded-lg p-2 md:p-3 mr-3 md:mr-4">
                            Q.{{ $currentIndex + 1 }}
                        </div>
                        <div class="flex-1">
                            <h3 class="text-base md:text-xl font-semibold text-gray-800 leading-relaxed">{{ $q->question_text }}</h3>
                        </div>
                    </div>

                    <div class="space-y-2 md:space-y-3 pl-16">
                        @foreach ($q->options as $opt)
                            <label class="flex items-center p-3 md:p-4 rounded-xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 cursor-pointer group"
                                wire:key="option-{{ $q->id }}-{{ $opt->id }}">
                                <div class="flex items-center h-5">
                                    <input type="radio" name="question_{{ $q->id }}" value="{{ $opt->id }}" wire:model.defer="answers.{{ $q->id }}"
                                        class="w-4 md:w-5 h-4 md:h-5 text-blue-600 border-gray-300 focus:ring-blue-500 focus:ring-2 cursor-pointer"
                                        @checked(isset($answers[$q->id]) && $answers[$q->id] == $opt->id)>
                                </div>
                                <div class="ml-3 text-sm w-full">
                                    <span class="font-medium text-gray-700 group-hover:text-gray-900">{{ $opt->option_text }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <!-- prev next button -->
                    <div class="space-y-3 mt-4 md:mt-6">
                        <div class="flex justify-between">
                            <button wire:click="prev"
                                    class="px-3 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-all duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    @disabled($currentIndex === 0)>
                                <i class="fa-solid fa-chevron-left mr-2"></i> Previous
                            </button>

                            <button wire:click="next"
                                    class="px-3 py-2 bg-blue-100 text-blue-700 font-medium rounded-xl hover:bg-blue-200 transition-all duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    @disabled($currentIndex >= count($questions) - 1)>
                                Next<i class="fa-solid fa-chevron-right ml-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Navigation -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 h-auto">
                    <h4 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">
                        <i class="fa-solid fa-map-location-dot fa-lg mr-2"></i>Navigate
                    </h4>

                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($questions as $index => $question)
                            <button wire:click="goTo({{ $index }})" wire:key="nav-{{ $question->id }}" class="relative focus:outline-none">
                                <div class="w-10 h-10 flex items-center justify-center rounded-lg font-medium text-sm transition-all duration-200
                                    @if($index === $currentIndex)
                                        ring-2 ring-emerald-400 bg-emerald-50 text-emerald-700 scale-110
                                    @elseif(isset($answers[$question->id]) && $answers[$question->id])
                                        bg-emerald-100 text-emerald-800 border border-emerald-200
                                    @else
                                        bg-gray-100 text-gray-700 hover:bg-gray-200
                                    @endif">
                                    {{ $index + 1 }}
                                </div>

                                @if($index === $currentIndex)
                                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-600 rounded-full animate-ping"></div>
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <button wire:click="submit"
                            class="w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-emerald-500 text-white font-semibold rounded-xl hover:from-blue-500 hover:to-emerald-600 transition-all duration-200 flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane"></i>Submit Exam
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
