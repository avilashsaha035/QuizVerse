<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\{Question, Option, QuestionExplanation};


class QuestionsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $question = new Question();
            $question->question_text = $row['question_text'];
            $subject = Subject::where('slug', $row['subject_slug'])->first();
            if (!$subject) {
                throw new \Exception("Subject with slug '{$row['subject_slug']}' not found.");
            }
            $question->subject_id    = $subject->id;
            $question->exam_type     = $row['exam_type'];
            // $question->language      = $row['language'] ?? 'en';
            $question->created_by    = Auth::id();
            $question->save();

            foreach (range(1, 4) as $i) {
                $option = new Option();
                $option->question_id = $question->id;
                $option->option_text = $row["option_$i"];
                $option->is_correct  = ((int)$row['correct_option'] === $i);
                $option->save();
            }

            if (!empty($row['explanation_text'])) {
                $explanation = new QuestionExplanation();
                $explanation->question_id      = $question->id;
                $explanation->explanation_text = $row['explanation_text'];
                $explanation->language         = $row['language'] ?? 'en';
                $explanation->save();
            }
        }
    }
}

