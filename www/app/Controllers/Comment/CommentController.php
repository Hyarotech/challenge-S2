<?php

namespace App\Controllers\Comment;

use App\Models\Comment;

class CommentController
{
    public function showAll()
    {
        $comments = Comment::findAll();
        dd($comments);
    }
}