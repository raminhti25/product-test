<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(?User $user, $product)
    {
        if (is_null($user) && $product->comment_enabled && $product->edit_by_visitor_enabled) {
            return Response::allow();
        }

        return Response::deny(trans('messages.errors.cant_leave_comment'));
    }
}
