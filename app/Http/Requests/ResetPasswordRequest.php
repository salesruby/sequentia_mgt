<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

class ResetPasswordRequest extends ParentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Gate::allows('user') || Gate::allows('admin'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password' =>'required|min:8',
            'new_password' =>'required|min:8',
            'password_confirmation' =>'required|min:8|same:new_password'
        ];
    }
}
