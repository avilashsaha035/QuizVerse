<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index()
    {
        return view('backend.exam.index');
    }

    public function create()
    {
        $data['subjects'] = Subject::get();
        return view('backend.exam.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string',
            'exam_type'        => 'required|string',
            'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'no_of_ques'       => 'nullable|integer|min:1',
            'pass_marks'       => 'nullable|integer',
            'access_code'      => 'nullable|string|max:50',
            'is_shuffling'     => 'nullable|integer|in:0,1',
            'is_active'        => 'nullable|integer|in:0,1',
            'start_date'       => 'nullable|date',
            'start_time'       => 'nullable|date_format:H:i',
            'end_date'         => 'nullable|date|after_or_equal:start_date',
            'end_time'         => 'nullable|date_format:H:i',
            'subject_ids'      => 'required|array|min:1',
            'subject_ids.*'    => 'exists:subjects,id',
            'subject_counts'   => 'required|array|min:1',
            'subject_counts.*' => 'integer|min:1',
        ]);

        if (!auth()->check()) {
            return back()->withErrors(['error' => 'You must be logged in.']);
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('exam_thumbnails', 'public');
        }

        DB::beginTransaction();
        try {
            $exam = new Exam();
            $exam->title            = $validated['title'];
            $exam->slug             = Str::slug($validated['title']) . '-' . uniqid();
            $exam->exam_type        = $validated['exam_type'];
            $exam->thumbnail        = $thumbnailPath;
            $exam->description      = $validated['description'] ?? null;
            $exam->duration_minutes = $validated['duration_minutes'];
            $exam->no_of_ques       = $validated['no_of_ques'] ?? array_sum($validated['subject_counts']);
            $exam->pass_marks       = $validated['pass_marks'] ?? null;
            $exam->access_code      = $validated['access_code'] ?? null;
            $exam->is_shuffling     = $validated['is_shuffling'] ?? 0;
            $exam->is_active        = $validated['is_active'] ?? 0;
            $exam->start_date       = $validated['start_date'] ?? null;
            $exam->start_time       = $validated['start_time'] ?? null;
            $exam->end_date         = $validated['end_date'] ?? null;
            $exam->end_time         = $validated['end_time'] ?? null;
            $exam->created_by       = auth()->id();

            $exam->save();

            foreach ($validated['subject_ids'] as $i => $subjectId) {
                $exam->subjects()->attach($subjectId, [
                    'question_count' => $validated['subject_counts'][$i],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

}
