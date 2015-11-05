<?php

namespace App\Http\Requests;

use Code4\Platform\Models\User;

class UserUpdateRequest extends Request
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
        ];

        //Jeżeli zmienił się email - sprawdzamy czy
        if ($this->request->has('email') && User::find($this->request->get('id'))->email != $this->request->get('email')) {
            $rules['email'] = 'required|unique:users';
        }

        if ($this->request->has('password') && $this->request->get('password') != '') {
            $rules['password'] = 'required|same:password2';
            $rules['password2'] = 'required';
        }

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
