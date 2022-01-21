<?php

namespace App\Interfaces;


interface CommentRepositoryInterface
{
    public function index(array $data);
    public function getProductComments(int $product_id, array $data);
    public function getProductTotalComments(int $product_id);
    public function show(int $id);
    public function store(array $data);
    public function update($comment, array $data);
    public function destroy($comment);
}