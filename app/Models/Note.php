<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['title','content','is_pinned'];
    protected $casts = ['is_pinned' => 'boolean'];

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }

}
