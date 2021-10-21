<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'body'
    ];

    /**
     * Get the attachments for the blog post.
     */
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
