<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'type' => 'required',
        ];

        if(in_array($this->method() , ['PUT', 'PATCH'])){
            $admin = $this->route()->parameter('user');
            // dd($admin);
            $rules['email'] = 'unique:users,email,' . $admin . ',id';
            $rules['password'] = '';
        }
        return $rules;
    }
    protected function prepareForValidation()
    {
        return $this->merge(
            [
                'type' => 'user',
            ]
        );
    }
}
