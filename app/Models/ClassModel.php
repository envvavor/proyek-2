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
        return $this->belongsToMany(User::class, 'class_user');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    protected $fillable = ['id', 'name']; // Menyebutkan kolom yang bisa diisi
}
