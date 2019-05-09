<?php

namespace App\Policies;

use App\User;
use App\Inquiry;
use Illuminate\Auth\Access\HandlesAuthorization;

class InquiryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function view(User $staff)
    {
        return isset($staff) === true;
    }

    /**
     * Determine whether the user can create inquiries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(?User $staff)
    {
        return $staff === null;
    }

    /**
     * Determine whether the user can update the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function update(User $staff, Inquiry $inquiry)
    {
        if ($inquiry->status === '未対応') {
            return isset($staff) === true;
        }elseif ($inquiry->status === '対応中' || '対応済') {
            return $staff->id === $inquiry->staff_id;
        }
    }

    /**
     * Determine whether the user can update the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function reply(User $staff, Inquiry $inquiry)
    {
        return $staff->id === $inquiry->staff_id;
    }

    /**
     * Determine whether the user can update the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function comment(User $staff, Inquiry $inquiry)
    {
        return $staff->id === $inquiry->staff_id;
    }

    /**
     * Determine whether the user can delete the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function delete(User $user, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can restore the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function restore(User $user, Inquiry $inquiry)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inquiry.
     *
     * @param  \App\User  $user
     * @param  \App\Inquiry  $inquiry
     * @return mixed
     */
    public function forceDelete(User $user, Inquiry $inquiry)
    {
        //
    }
}
