<?php

namespace Phoenix\Policies\Unit\Documentation;

use Phoenix\Models\User;
use Phoenix\Models\Unit\Documentation\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->hasRole('superadmin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param  \Phoenix\Models\User  $user
     * @param  \Phoenix\Models\Unit\Documentation\Category $category
     * @return mixed
     */
    public function view(User $user, Category $category)
    {
        return true;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \Phoenix\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole('documentation')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \Phoenix\Models\User  $user
     * @param  \Phoenix\Models\Unit\Documentation\Category $category
     * @return mixed
     */
    public function update(User $user, Category $category)
    {
        if ($user->hasRole('documentation')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \Phoenix\Models\User  $user
     * @param  \Phoenix\Models\Unit\Documentation\Category $category
     * @return mixed
     */
    public function delete(User $user, Category $category)
    {
        if ($user->hasRole('documentation')) {
            return true;
        } else {
            return false;
        }
    }
}
