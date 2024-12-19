<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        $assignments = Assignment::where('subject_id', $id)->get();
        
        return view('subjects.show', compact('subject', 'assignments'));
    }

    public function index(Request $request)
    {
        $subjects = Subject::all();

        // Cek peran pengguna
        if ($request->user()->role == 1) { // Admin
            return view('admin.dashboard', compact('subjects'));
        } elseif ($request->user()->role == 2) { // Guru
            return view('guru.dashboard', compact('subjects'));
        } elseif ($request->user()->role == 3) { // Murid
            return view('murid.dashboard', compact('subjects'));
        }

        abort(403, 'Unauthorized access.');
    }
        
}
