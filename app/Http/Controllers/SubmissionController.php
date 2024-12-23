<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assignment;
use App\Models\Submission;
class SubmissionController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('class_id', auth()->user()->class_id)
            ->with(['submissions' => function ($query) {
                $query->where('student_id', auth()->id());
            }])
            ->get();

        return view('submissions.index', compact('assignments'));
    }


    public function store(Request $request, $assignmentId)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:pdf,docx,zip',
        ]);

        $path = $request->file('file')->store('private/public/submissions');

        Submission::create([
            'assignment_id' => $assignmentId,
            'student_id' => auth()->id(),
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan');
    }
    
    public function indexAll(Request $request)
    {
        $query = Submission::query();

        if ($request->filled('subject_id')) {
            $query->whereHas('assignment', function ($q) use ($request) {
                $q->where('subject_id', $request->subject_id);
            });
        }

        if ($request->filled('class_id')) {
            $query->whereHas('assignment', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        if ($request->filled('assignment_id')) {
            $query->where('assignment_id', $request->assignment_id);
        }

        // Menggunakan pagination dengan 10 item per halaman
        $submissions = $query->with('assignment', 'student')->paginate(5);

        // Menambahkan parameter filter ke link pagination
        $submissions->appends($request->all());

        $assignments = Assignment::all(); // To populate the filter dropdowns
        $subjects = Assignment::select('subject_id')->distinct()->get();
        $classes = Assignment::select('class_id')->distinct()->get();

        return view('submissions.index_all', compact('submissions', 'assignments', 'subjects', 'classes'));
    }
    
    public function countPendingAssignments()
    {
        $userClassId = auth()->user()->class_id;
        $userId = auth()->id();

        // Ambil semua tugas untuk kelas pengguna
        $assignments = Assignment::where('class_id', $userClassId)->get();

        // Hitung tugas yang belum dikerjakan oleh pengguna
        $pendingAssignmentsCount = 0;
        foreach ($assignments as $assignment) {
            $submission = Submission::where('assignment_id', $assignment->id)
                ->where('student_id', $userId)
                ->first();
            if (!$submission) {
                $pendingAssignmentsCount++;
            }
        }

        return $pendingAssignmentsCount;
    }

    public function studentDashboard()
    {
        $pendingAssignmentsCount = $this->countPendingAssignments();
        return view('murid.dashboard', compact('pendingAssignmentsCount'));
    }
    
    public function destroy($id)
    {
        $submission = Submission::findOrFail($id);
        $submission->delete();

        return redirect()->route('submissions.index')->with('success', 'Submission deleted successfully.');
    }
}
