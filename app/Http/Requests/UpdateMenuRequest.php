<?php

namespace App\Http\Requests;

use Flash;
use App\Http\Requests\Request;
use Illuminate\Contracts\Validation\Validator;

class UpdateMenuRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return hasPermission('menu_update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'icon' => 'required|string',
            'parent_slug' => 'sometimes|string|no_specials_lower_u|exists:menus,slug',
            'menu_order' => 'required|integer|min:0',
            'title' => 'required|string|max:100',
            // 'url' => '', not required, can be empty
            // 'description' => '', not required, can be empty
            'permission_id' => 'required|integer|exists:permissions,id',
            'menu_group' => 'required|string|in:'.implode(",", crminfo('menu_groups')),
        ];
    }

    /**
    * {@inheritdoc}
    */
    protected function formatErrors(Validator $validator)
    {
        $validator->errors()->add('error_code', '6');
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
