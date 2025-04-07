<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'media'];

    // Relacionamento com Section
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
