<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = ['title','content','is_pinned', 'user_id'];
    protected $casts = ['is_pinned' => 'boolean'];

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
