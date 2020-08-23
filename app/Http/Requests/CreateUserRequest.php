<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('user_management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|max:255|string',
            'username'  => 'required|max:255|username|unique:users',
            'email'  => 'required|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
        $validator->errors()->add('error_code', '5');
        return parent::formatErrors($validator);
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
