<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title','notes','is_done','priority'];
    protected $casts = [
    'is_done' => 'boolean',
    ];
}
