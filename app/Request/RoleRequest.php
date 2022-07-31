<?php

declare(strict_types=1);

namespace App\Request;

use App\Model\AdminRole;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class RoleRequest extends FormRequest
{
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
        $rules= [
            'description'=>'required',
            'status'=>['required',Rule::in([AdminRole::STATUS_OK,AdminRole::STATUS_DISABLE])],
            'node'=>'required|array'
        ];

        if($this->getRequest()->getMethod()=='POST'){
            return array_merge($rules,[  'name'=>'required|unique:admin_roles']);
        } else{
            return array_merge($rules,[  'name'=>'required']);
        }
    }
}
