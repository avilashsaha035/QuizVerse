<?php

namespace App\Http\Controllers\Backend;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\DataTables\SubjectDataTable;
use App\Http\Controllers\Controller;

class ExamSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubjectDataTable $dataTable)
    {
        return $dataTable->render('backend.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'            => 'required',
            'slug'            => 'required',
        ]);

        $subject = new Subject();
        $subject->name            = $validated['name'];
        $subject->slug            = $validated['slug'];

        $subject->save();

        return redirect()->back()->with('success', 'Subject created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
