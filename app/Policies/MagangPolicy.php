<?php

namespace App\Policies;

use App\Models\Magang;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MagangPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->level == 'admin' || $user->level == 'opd' || $user->level == 'mahasiswa'
            ? Response::allow()
            : abort(404);
    }

    public function updateStatus(User $user,Magang $magang)
    {
        return $user->level == 'opd' && $user->id && $magang->user_id
            ? Response::allow()
            : abort(404);
    }


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->level == 'admin'
            ? Response::allow()
            : abort(404);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Magang $magang)
    {
        return $user->level == 'admin' && $user->name == $magang->name
            ? Response::allow()
            : abort(404);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Magang $magang)
    {
        return $user->level == 'admin'& $user->name == $magang->name
            ? Response::allow()
            : abort(404);
    }
}
