<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTags extends Model
{
    use HasFactory;

    protected $fillable = ['tag_type', 'project_id', 'tag_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
