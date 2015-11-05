<?php

namespace App\Http\Requests;

class UserStoreRequest extends Request
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
        $rules = [
            'email' => 'required|unique:users',
            'password' => 'required|same:password2',
            'password2' => 'required'
        ];
        if (!is_array($this->request->get('role')))
        {
            $rules['role'] = 'required';
        }
        return $rules;
    }

    public function messages() {
        return [
            'role.required' => 'Wybierz przynajmniej jedną rolę',
        ];
    }

}
