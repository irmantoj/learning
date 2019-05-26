<?php

namespace App\Policies;

use App\User;
use App\Motorcycle;
use Illuminate\Auth\Access\HandlesAuthorization;

class UpdatePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Motorcycle $motorcycle)
    {
      return $user->id == 1;
    }
}
