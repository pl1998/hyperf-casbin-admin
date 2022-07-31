<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class UserRequest extends FormRequest
{
    public $scenes =[
      'store'=>['name','email','password','password_confirmation','roles'],
      'update'=>['name','email','roles'],
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:20|unique:admin_users,name',
            'email'=>'required|email|unique:admin_users,email',
            'password'=>'required|min:6|max:20|confirmed:password_confirmation',
            'password_confirmation'=>'required',
            'roles'=>'required|array'
        ];
    }
}
