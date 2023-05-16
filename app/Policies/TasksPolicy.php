<?php

namespace App\Policies;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        // dd('policy authorized');
        // echo "test";
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Tasks $task)
    {
        return $user->isAdmin===1 || $user->id === $task->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->id == auth()->user()->id;

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Tasks $tasks)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Tasks $tasks)
    {
        //
    }
}
