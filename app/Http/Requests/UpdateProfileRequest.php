<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use Flash;

class UpdateProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(!(hasPermission('user_management') || (Auth::user()->username == $this->route('username')))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'birthday' => 'required|string|date_format:Y-m-d',
            'gender' => 'required|string',
            'phone' => 'sometimes|string|max:18',
            'address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'website' => 'sometimes|url',
            'facebook_username' => 'sometimes|string',
            'google_username' => 'sometimes|string',
            'biography' => 'sometimes|string',
        ];
    }

    /**
     * Get the response for a forbidden operation.
     */
    public function forbiddenResponse()
    {
        Flash::error(trans('VNPCMS.messages.nopermission'));
        return back();
    }
}
