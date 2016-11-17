<?php

namespace Phoenix\Http\Requests\User\Teamspeak;

use Illuminate\Foundation\Http\FormRequest;
use Phoenix\Models\User\Teamspeak;

class RemoveTeamspeakToFile extends FormRequest
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

            // Action 2 - Determine if the user owns the Teamspeak object
            $teamspeak = Teamspeak::findOrFail($this->route('teamspeak')->id);

            if (\Gate::forUser($this->user())->allows('delete-teamspeak', $teamspeak)) {
                return true;
            }

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
