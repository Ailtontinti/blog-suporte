<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'type', 'content'];

    // Relacionamento com Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
