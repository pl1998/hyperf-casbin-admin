<?php
declare(strict_types=1);
/**
 * Created By PhpStorm.
 * User : Latent
 * Date : 2022/7/31
 * Time : 11:54
 **/

namespace App\Request;
use App\Model\AdminPermission;
use Hyperf\Validation\Request\FormRequest;
use Hyperf\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'icon'=>'required',
            'api_route'=>'required',
            'route'=>'required',
            'title'=>'required',
            'title_en'=>'required',
            'status'=>['required',Rule::in([AdminPermission::STATUS_OK,AdminPermission::STATUS_DISABLE])],
            'method'=>[
                'required',
                Rule::in([
                        AdminPermission::HTTP_REQUEST_ALL,
                        AdminPermission::HTTP_REQUEST_GET,
                        AdminPermission::HTTP_REQUEST_POST,
                        AdminPermission::HTTP_REQUEST_PUT,
                        AdminPermission::HTTP_REQUEST_PATCH,
                        AdminPermission::HTTP_REQUEST_DELETE,
                    ])],
            'p_id'=>'required',
            'hidden'=>[
                'required',
                Rule::in([AdminPermission::HIDDEN_OK,AdminPermission::HIDDEN_NO])
            ],
            'is_menu'=>[
                'required',
                Rule::in([AdminPermission::IS_MENU_NO,AdminPermission::IS_MENU_YES])
            ],
            ];
    }

}
