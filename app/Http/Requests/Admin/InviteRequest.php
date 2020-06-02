<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InviteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // TODO: custom role validators toevoegen?
        return [
            'emails' => 'required|array|min:1',
            'email.*' => 'required|string|email|max:255|unique:users',
            'roles' => 'required|array|min:1',
        ];
    }
}
