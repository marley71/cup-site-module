<?php

namespace Modules\CupSite\Policies;

use App\Models\User;
use App\Models\CupSiteNews;
use Illuminate\Auth\Access\HandlesAuthorization;
use Gecche\PolicyBuilder\Facades\PolicyBuilder;

class CupSiteNewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CupSiteNews  $model
     * @return mixed
     */
    public function view(User $user, CupSiteNews $model)
    {
        //
        if ($user && $user->can('view cup_site_news')) {
            return true;
        }

        return false;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\CupSiteUser  $user
     * @return mixed
     */
    public function create(CupSiteUser $user)
    {
        //
        if ($user && $user->can('create cup_site_news')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CupSiteNews  $model
     * @return mixed
     */
    public function update(User $user, CupSiteNews $model)
    {
        //
        if ($user && $user->can('edit cup_site_news')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CupSiteNews  $model
     * @return mixed
     */
    public function delete(User $user, CupSiteNews $model)
    {
        //
        if ($user && $user->can('delete cup_site_news')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function listing(User $user)
    {
        //
        if ($user && $user->can('list cup_site_news')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can access to the listing of the models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function acl(User $user, $builder)
    {

//        if ($user && $user->can('view all cup_geo_comune')) {
//            return Gate::aclAll($builder);
//        }

        if ($user && $user->can('view cup_site_news')) {
            return PolicyBuilder::all($builder,CupSiteNews::class);
        }

        return PolicyBuilder::all($builder,CupSiteNews::class);
    }
}
