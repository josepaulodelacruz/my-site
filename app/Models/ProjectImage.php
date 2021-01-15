<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function setFileAttribute($value)
    {
        return $this->attributes['image'] = json_encode($value);
    }

    public function project()
    {
        return $this->belongsToMany(Project::class);
    }
}
