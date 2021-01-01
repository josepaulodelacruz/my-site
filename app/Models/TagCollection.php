<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagCollection extends Model
{
    use HasFactory;

    protected $fillable = ['tag_type', 'blog_id', 'project_id', 'tag_id'];

    public function blogs ()
    {
        return $this->belongsToMany(Blog::class);
    }

    public function tag ()
    {
        return $this->belongsTo(Tag::class);
    }
}
