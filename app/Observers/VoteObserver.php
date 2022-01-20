<?php

namespace App\Observers;

use App\Models\Vote;

class VoteObserver
{
    public function creating(Vote $vote)
    {
        $vote->status = Vote::PENDING;
    }
}
