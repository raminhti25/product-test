<?php

namespace App\Interfaces;


interface VoteRepositoryInterface
{
    public function index(array $data);
    public function show(int $id);
    public function averageVote(int $product_id);
    public function store(array $data);
    public function update($vote, array $data);
    public function destroy($vote);
}