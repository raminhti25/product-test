<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function show(int $id)
    {
        return Comment::findOrFail($id);
    }

    public function store(array $data)
    {
        return Comment::create($data);
    }

    public function update($comment, array $data)
    {
        $comment->fill($data);

        $comment->save();
    }

    public function destroy($comment)
    {
        $comment->delete();
    }
}