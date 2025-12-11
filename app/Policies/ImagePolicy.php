<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Image;

class ImagePolicy
{
    public function update(User $user, Image $image)
    {
        return $user->id === $image->user_id || $user->isAdmin();
    }

    public function delete(User $user, Image $image)
    {
        return $user->id === $image->user_id || $user->isAdmin();
    }
}
