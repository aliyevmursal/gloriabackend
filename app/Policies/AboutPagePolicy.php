<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\AboutPage;
use MoonShine\Laravel\Models\MoonshineUser;

class AboutPagePolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, AboutPage $item): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return false;
    }

    public function update(MoonshineUser $user, AboutPage $item): bool
    {
        return true;
    }

    public function delete(MoonshineUser $user, AboutPage $item): bool
    {
        return false;
    }

    public function restore(MoonshineUser $user, AboutPage $item): bool
    {
        return false;
    }

    public function forceDelete(MoonshineUser $user, AboutPage $item): bool
    {
        return false;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return false;
    }
}