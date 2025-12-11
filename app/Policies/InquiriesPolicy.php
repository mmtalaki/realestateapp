<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Inquiries;

class InquiriesPolicy
{
    public function update(User $user, Inquiries $inquiries)
    {
        return $user->id === $inquiries->user_id || $user->isAdmin();
    }

    public function delete(User $user, Inquiries $inquiries)
    {
        return $user->id === $inquiries->user_id || $user->isAdmin();
    }
}
