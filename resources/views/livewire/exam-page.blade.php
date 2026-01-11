<div>
    <!-- Exam Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold">{{ $exam['title'] }}</h2>
            <p class="text-sm text-gray-600">
                Duration: {{ $exam['duration_minutes'] }} minutes • Pass mark: {{ $exam['pass_marks'] }}
            </p>
        </div>
        <div wire:poll.1000ms="tick" class="text-red-600 font-bold" wire:key="timer">
            Time left: {{ gmdate('i:s', $timeRemaining) }}
        </div>
    </div>

    <!-- Progress -->
    <div class="mb-4 text-gray-700">
        Question {{ $currentIndex + 1 }} of {{ count($questions) }}
    </div>

    <!-- Current Question -->
    @php $q = $questions[$currentIndex]; @endphp
    <div class="p-4 rounded-lg border mb-6" wire:key="question-{{ $q->id }}">
        <div class="font-medium mb-2">{{ $q->question_text }}</div>
        <div class="space-y-2">
            @foreach ($q->options as $opt)
                <label class="flex items-center space-x-2" wire:key="option-{{ $q->id }}-{{ $opt->id }}">
                    <input type="radio"
                        name="question_{{ $q->id }}"
                        value="{{ $opt->id }}"
                        wire:model.defer="answers.{{ $q->id }}"@checked(isset($answers[$q->id]) && $answers[$q->id] == $opt->id)>
                    <span>{{ $opt->option_text }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between mt-4">
        <button wire:click="prev" class="px-4 py-2 bg-amber-400 hover:bg-amber-600 text-white rounded @if($currentIndex === 0) opacity-50 cursor-not-allowed @endif" @disabled($currentIndex === 0)> Previous </button>

        @if($currentIndex < count($questions) - 1)
            <button wire:click="next" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded"> Next </button>
        @else
            <button wire:click="submit" class="px-6 py-3 bg-emerald-600 amber hover:bg-emerald-700 text-white rounded-lg font-semibold"> Submit Exam </button>
        @endif
    </div>
</div>
