<?php

namespace App\Interfaces;


interface VoteRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function store(array $data);
    public function update($vote, array $data);
    public function destroy($vote);
}