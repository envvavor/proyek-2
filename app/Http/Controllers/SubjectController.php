<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function show($id, Request $request)
    {
        $subject = Subject::findOrFail($id);
        $assignments = Assignment::where('subject_id', $id)
                                  ->whereHas('class', function($query) use ($request) {
                                      $query->where('id', $request->user()->class_id);
                                  })
                                  ->get();
        
        return view('subjects.show', compact('subject', 'assignments'));
    }

    public function index()
    {
        $subjects = Subject::all();
        return response()->json(['subjects' => $subjects]);
    }
    
    public function list()
    {
        $subjects = Subject::paginate(5);
        return view('subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update($validated);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
