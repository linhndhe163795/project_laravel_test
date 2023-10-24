<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
     * @return array<string, mixed>
     */

    public function rules()
    {
        $id = $this->input('id');

        $rules = [];

        if ($this->has('name')) {
            $rules['name'] = ['max:128', Rule::unique('m_teams')->ignore($id)];
        }
        if ($this->has('email')) {
            $rules['email'] = ['max:128', 'email', Rule::unique('m_employees')->ignore($id)];
        }
        if ($this->has('password')) {
            $rules['password'] = ['required', 'max:128'];
        }
        if ($this->has('salary')) {
            $rules['salary'] = ['required', 'numeric','max:99999999999'];
        }

        if ($this->has('first_name')) {
            $rules['first_name'] = ['required', 'max:128'];
        }

        if ($this->has('last_name')) {
            $rules['last_name'] = ['required', 'max:128'];
        }

        if ($this->has('address')) {
            $rules['address'] = ['required', 'max:128'];
        }

        if ($this->has('status')) {
            $rules['status'] = ['required'];
        }

        if ($this->has('birthday')) {
            $rules['birthday'] = ['required'];
        }

        if ($this->has('avatar')) {
            $rules['avatar'] = ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }
        
        return $rules;
    }
}
