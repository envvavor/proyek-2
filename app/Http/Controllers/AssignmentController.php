<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assignment;
use App\Models\ClassModel; // Model untuk tabel classes
use App\Models\Subject;    // Model untuk tabel subjects
class AssignmentController extends Controller
{
    public function create()
    {
        $classes = ClassModel::all();
        $subjects = Subject::all();

        return view('assignments.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'due_date' => 'required|date',
        ]);

        Assignment::create([
            'teacher_id' => auth()->id(),
            'class_id' => $validated['class_id'],
            'subject_id' => $validated['subject_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
        ]);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dibuat');
    }

    public function index(Request $request)
    {

        $subjects = Subject::all();
        // Ambil ID mata pelajaran dari request (jika ada)
        $subjectId = $request->get('subject_id');

        // Filter tugas berdasarkan mata pelajaran jika subject_id diberikan
        $assignments = Assignment::with(['class', 'subject'])
            ->when($subjectId, function ($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            })
            ->get();

        // Ambil daftar semua mata pelajaran untuk dropdown filter
        $subjects = Subject::all();

        return view('assignments.index', compact('assignments', 'subjects', 'subjectId'));
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $classes = ClassModel::all(); // Semua kelas
        $subjects = Subject::all(); // Semua mata pelajaran

        return view('assignments.edit', compact('assignment', 'classes', 'subjects'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'due_date' => 'required|date',
        ]);

        $assignment = Assignment::findOrFail($id);
        $assignment->update($request->all());

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function filterBySubject($id)
    {
        // Ambil mata pelajaran berdasarkan ID
        $subject = Subject::findOrFail($id);

        // Ambil tugas-tugas yang terkait dengan mata pelajaran tersebut
        $assignments = Assignment::where('subject_id', $id)->get();

        return view('assignments.index', compact('assignments', 'subject'));
    }

        
}
