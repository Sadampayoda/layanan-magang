<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserMagangPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user)
    {
        return ($user->level == 'mahasiswa') || ($user->level == 'opd') ? Response::allow()
        : abort(404);
    }

    public function create(User $user)
    {
        return ($user->level == 'mahasiswa') ? Response::allow()
        : abort(404);
    }
}
