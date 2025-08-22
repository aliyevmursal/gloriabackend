<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Contact;
use MoonShine\Laravel\Models\MoonshineUser;

class ContactPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Contact $item): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return false;
    }

    public function update(MoonshineUser $user, Contact $item): bool
    {
        return false;
    }

    public function delete(MoonshineUser $user, Contact $item): bool
    {
        return true;
    }

    public function restore(MoonshineUser $user, Contact $item): bool
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Contact $item): bool
    {
        return true;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
