<?php

namespace App\Policies;

use App\Models\Advertisement;
use App\Models\User;

class AdvertisementPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Advertisement $advertisement): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user_id ||
               $user->hasRole('administrator');
    }

    public function delete(User $user, Advertisement $advertisement): bool
    {
        return $user->id === $advertisement->user_id ||
               $user->hasRole('administrator');
    }

    public function moderate(User $user): bool
    {
        return in_array($user->role?->slug, ['administrator', 'moderator']);
    }
}