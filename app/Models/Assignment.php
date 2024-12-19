<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    // Izinkan kolom ini untuk diisi secara massal
    protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id',
        'title',
        'description',
        'due_date',
    ];

    // Relasi dengan tabel users (sebagai teacher)
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // Relasi dengan tabel classes
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id'); // Ganti `ClassModel` dengan model kelas Anda
    }

    // Relasi dengan tabel subjects
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function classModel()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
