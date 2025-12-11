<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Property;

class PropertyPolicy
{
    public function update(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }

    public function delete(User $user, Property $property)
    {
        return $user->id === $property->user_id || $user->isAdmin();
    }
}
