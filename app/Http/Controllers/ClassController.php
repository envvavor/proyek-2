<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassModel;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();

        return view('guru.dashboard', compact('classes'));
    }

    public function show(Request $request, $id)
    {
        $class = ClassModel::findOrFail($id);
        $subjects = Subject::all(); // Ambil semua mata pelajaran untuk dropdown atau filter
        $assignments = Assignment::where('class_id', $id)
            ->when($request->input('subject_id'), function ($query, $subjectId) {
                return $query->where('subject_id', $subjectId);
            })
            ->get();

        return view('classes.show', compact('class', 'assignments', 'subjects'));
    }


}
