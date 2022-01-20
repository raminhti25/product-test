<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Interfaces\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function index()
    {
        //
    }

    public function getProductComments(int $product_id, array $data)
    {
        $limit = $data['limit'] ?? 3;

        return Comment::product($product_id)->approved()->latest()->limit($limit)->all();
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

    public function getProductTotalComments(int $product_id)
    {
        return Comment::product($product_id)->approved()->count();
    }
}