<?php

namespace App\Interfaces;


interface CommentRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function store(array $data);
    public function update($comment, array $data);
    public function destroy($comment);
}