<div>
    <!-- Exam Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-xl font-bold">{{ $exam['title'] }}</h2>
            <p class="text-sm text-gray-600">
                Duration: {{ $exam['duration_minutes'] }} minutes • Pass mark: {{ $exam['pass_marks'] }}
            </p>
        </div>
        <div class="text-lg font-semibold text-red-600">
            Time left: {{ gmdate("i:s", $timeRemaining) }}
        </div>
    </div>

    <!-- Progress -->
    <div class="mb-4 text-gray-700">
        Question {{ $currentIndex + 1 }} of {{ count($questions) }}
    </div>

    <!-- Current Question -->
    @php $q = $questions[$currentIndex]; @endphp
    <div class="p-4 rounded-lg border mb-6">
        <div class="font-medium mb-2">{{ $q['question_text'] }}</div>
        <div class="space-y-2">
            @foreach ($q['options'] as $opt)
                <label class="flex items-center space-x-2">
                    <input type="radio"
                           name="q_{{ $q['id'] }}"
                           wire:click="selectAnswer({{ $q['id'] }}, {{ $opt['id'] }})"
                           {{ (isset($answers[$q['id']]) && $answers[$q['id']] === $opt['id']) ? 'checked' : '' }}>
                    <span>{{ $opt['option_text'] }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between">
        <button wire:click="prev"
                class="px-4 py-2 bg-green-600 rounded"
                @if($currentIndex === 0) disabled @endif>
            Previous
        </button>

        @if($currentIndex < count($questions) - 1)
            <button wire:click="next"
                    class="px-4 py-2 bg-red-600 text-white rounded">
                Next
            </button>
        @else
            <button wire:click="submit"
                    class="px-6 py-3 bg-green-600 text-white rounded-lg font-semibold">
                Submit Exam
            </button>
        @endif
    </div>
</div>
