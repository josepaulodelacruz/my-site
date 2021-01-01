<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function tagCollections()
    {
        return $this->hasMany(TagCollection::class);
    }
}
