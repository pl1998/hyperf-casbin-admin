<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class AuthRequest extends FormRequest
{
    protected $scenes = [
        'login' => ['email','password'],
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
            'email'=>'required|email',
            'password'=>'required|min:6|max:30'
        ];
    }
}
