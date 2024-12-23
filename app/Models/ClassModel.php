<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; 
    public function users()
    {
        return $this->hasMany(User::class, 'class_id'); // Relasi ke model User
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    protected $fillable = ['id', 'name']; // Menyebutkan kolom yang bisa diisi
}
