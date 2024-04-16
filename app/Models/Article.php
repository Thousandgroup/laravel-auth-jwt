<?php

namespace App\Models;

use App\Models\ArticleComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany(ArticleComment::class);
    }
}
