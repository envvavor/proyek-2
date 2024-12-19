<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assignment;
use App\Models\Submission;
class SubmissionController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('class_id', auth()->user()->class_id)->get();

        return view('submissions.index', compact('assignments'));
    }

    public function store(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,docx,zip',
        ]);

        $path = $request->file('file')->store('submissions');

        Submission::create([
            'assignment_id' => $assignmentId,
            'student_id' => auth()->id(),
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan');
    }

}
