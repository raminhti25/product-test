<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\VoteRepositoryInterface;
use App\Models\Vote;

class VoteRepository implements VoteRepositoryInterface
{
    public function index(array $data)
    {
        $votes = Vote::latest();

        return $votes->paginate($data['per_page'] ?? 10, '*', 'page', $data['page'] ?? 1);
    }

    public function show(int $id)
    {
        return Vote::findOrFail($id);
    }

    public function store(array $data)
    {
        return Vote::create($data);
    }

    public function update($vote, array $data)
    {
        $vote->fill($data);

        $vote->save();
    }

    public function destroy($vote)
    {
        $vote->delete();
    }

    public function averageVote(int $product_id)
    {
        return Vote::product($product_id)->approved()->average('value');
    }
}