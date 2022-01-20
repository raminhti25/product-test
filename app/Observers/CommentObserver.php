<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        $comment->status = Comment::PENDING;
    }
}
