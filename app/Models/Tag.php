<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

