<?php

namespace App\Repositories\Eloquent;

use App\Models\Vote;

class VoteRepository
{
    public function index()
    {
        // TODO: Implement index() method.
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
}