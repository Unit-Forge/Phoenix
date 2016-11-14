<?php

namespace Phoenix\Http\Requests\Unit\Group\Position;

use Illuminate\Foundation\Http\FormRequest;

class DeletePosition extends FormRequest
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
        } elseif (\Auth::User()->hasRole('superadmin'))
        {
            return true;
        } elseif(\Auth::User()->hasRole('records'))
        {
            return true;
        } else {
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
