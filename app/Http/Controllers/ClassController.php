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

    public function indexAll()
    {
        $classes = ClassModel::all();

        return view('classes.indexAll', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ClassModel::create($request->all());

        return redirect()->route('classes.indexAll')->with('success', 'Kelas berhasil dibuat.');
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);

        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = ClassModel::findOrFail($id);
        $class->update($request->all());

        return redirect()->route('classes.indexAll')->with('success', 'Kelas berhasil diubah.');
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.indexAll')->with('success', 'Kelas berhasil dihapus.');
    }

    public function count()
    {
        return ClassModel::count();
    }

}
