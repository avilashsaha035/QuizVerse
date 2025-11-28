<?php

namespace App\Http\Controllers\Backend;

use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\ExamDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index(ExamDataTable $dataTable)
    {
        // $exams = Exam::all();
        return $dataTable->render('backend.exam.index');
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
            $file = $request->file('thumbnail');
            $originalName = $file->getClientOriginalName();
            $file->storeAs('exam_thumbnails', $originalName, 'public');

            $thumbnailName = $originalName;
        }

        DB::beginTransaction();
        try {
            $exam = new Exam();
            $exam->title            = $validated['title'];
            $exam->slug             = Str::slug($validated['title']) . '-' . uniqid();
            $exam->exam_type        = $validated['exam_type'];
            $exam->thumbnail        = $thumbnailName;
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

    public function edit(Exam $exam)
    {
        // Eager load subjects via pivot
        $exam->load('subjects');
        $subjects = Subject::orderBy('name')->get();

        return view('backend.exam.edit', compact('exam', 'subjects'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title'                     => 'required|string|max:255',
            'exam_type'                 => 'required|string|max:50',
            'thumbnail'                 => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_existing_thumbnail' => 'nullable|integer|in:0,1',
            'description'               => 'nullable|string',
            'duration_minutes'          => 'required|integer|min:1',
            'no_of_ques'                => 'nullable|integer|min:1',
            'pass_marks'                => 'nullable|integer|min:0',
            'access_code'               => 'nullable|string|max:50',
            'is_shuffling'              => 'nullable|integer|in:0,1',
            'is_active'                 => 'nullable|integer|in:0,1',
            'start_date'                => 'nullable|date',
            'start_time'                => 'nullable|date_format:H:i',
            'end_date'                  => 'nullable|date|after_or_equal:start_date',
            'end_time'                  => 'nullable|date_format:H:i',

            'subject_ids'               => 'required|array|min:1',
            'subject_ids.*'             => 'required|integer|exists:subjects,id',
            'subject_counts'            => 'required|array|min:1',
            'subject_counts.*'          => 'required|integer|min:1',
        ]);

        $subjectIds    = array_values($validated['subject_ids']);
        $subjectCounts = array_values($validated['subject_counts']);

        if (count($subjectIds) !== count($subjectCounts)) {
            return back()->withErrors(['subject_counts' => 'Subjects and counts must match.'])->withInput();
        }

        $totalFromCounts = array_sum($subjectCounts);
        if (empty($validated['no_of_ques'])) {
            $validated['no_of_ques'] = $totalFromCounts;
        }

        $removeExisting = (int)($validated['remove_existing_thumbnail'] ?? 0) === 1;

        DB::beginTransaction();
        try {
            // Handle thumbnail removal
            if ($removeExisting && $exam->thumbnail) {
                Storage::disk('public')->delete('exam_thumbnails/'.$exam->thumbnail);
                $exam->thumbnail = null;
            }

            // Handle new thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old file if present
                if ($exam->thumbnail) {
                    Storage::disk('public')->delete('exam_thumbnails/'.$exam->thumbnail);
                }

                $file = $request->file('thumbnail');
                $originalName = $file->getClientOriginalName();

                // Store file in folder, but save only filename in DB
                $file->storeAs('exam_thumbnails', $originalName, 'public');
                $exam->thumbnail = $originalName;
            }

            // Explicit assignment
            $exam->title            = $validated['title'];
            if ($exam->getOriginal('title') !== $validated['title']) {
                $exam->slug = Str::slug($validated['title']).'-'.uniqid();
            }
            $exam->exam_type        = $validated['exam_type'];
            $exam->description      = $validated['description'] ?? null;
            $exam->duration_minutes = (int)$validated['duration_minutes'];
            $exam->no_of_ques       = (int)$validated['no_of_ques'];
            $exam->pass_marks       = $validated['pass_marks'] ?? null;
            $exam->access_code      = $validated['access_code'] ?? null;
            $exam->is_shuffling     = $validated['is_shuffling'] ?? 0;
            $exam->is_active        = $validated['is_active'] ?? 0;
            $exam->start_date       = $validated['start_date'] ?? null;
            $exam->start_time       = $validated['start_time'] ?? null;
            $exam->end_date         = $validated['end_date'] ?? null;
            $exam->end_time         = $validated['end_time'] ?? null;

            $exam->save();

            // Sync subjects pivot
            $syncData = [];
            foreach ($subjectIds as $i => $sid) {
                $syncData[$sid] = ['question_count' => (int)$subjectCounts[$i]];
            }
            $exam->subjects()->sync($syncData);

            DB::commit();
            return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully!');
            // return back()->with('success', 'Exam updated successfully!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update exam: '.$e->getMessage()])->withInput();
        }
    }

    public function destroy(Exam $exam)
    {
        // Delete thumbnail if exists
        if ($exam->thumbnail) {
            Storage::disk('public')->delete('exam_thumbnails/'.$exam->thumbnail);
        }
        $exam->delete();

        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully!');
    }

}
