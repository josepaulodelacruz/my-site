<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'body',
    ];

    public function nextBlog()
    {
        return $this::where('id', '!=', $this->id)->orderBy('created_at')->take(3)->get();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tagCollections()
    {
        return $this->hasMany(TagCollection::class);
    }

}
