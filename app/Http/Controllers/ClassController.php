<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();

        return view('guru.dashboard', compact('classes'));
    }

    public function show($id)
    {
        $class = ClassModel::findOrFail($id);
        $assignments = Assignment::where('class_id', $id)->get();
        
        return view('classes.show', compact('class', 'assignments'));
    }
}
