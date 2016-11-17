<?php

namespace Phoenix\Http\Requests\User\Teamspeak;

use Illuminate\Foundation\Http\FormRequest;
use Phoenix\Models\User;

class AddTeamspeakToFile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(\Auth::guest())
        {
            return false;
        } else {
            // Action 1 - Check if authenticated user is a superadmin
            if(\Auth::User()->hasRole('superadmin'))
                return true;

            // Action 2 - Find UUID from request and compare to authenticated user
            $user = User::where('uuid', $this->user_uuid)->firstOrFail();
            if($user->id == \Auth::User()->id)
                return true;

            // Action 3 - Fail request
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
