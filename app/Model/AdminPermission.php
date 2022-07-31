<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;

/**
 */
class AdminPermission extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_permissions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'api_route',
        'route',
        'title',
        'title_en',
        'status',
        'method',
        'p_id',
        'hidden',
        'is_menu',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    const HTTP_REQUEST_ALL = '*';
    const HTTP_REQUEST_GET = 'GET';
    const HTTP_REQUEST_POST = 'POST';
    const HTTP_REQUEST_PUT = 'PUT';
    const HTTP_REQUEST_PATCH = 'PATCH';
    const HTTP_REQUEST_DELETE = 'DELETE';

    const STATUS_OK = 0;
    const STATUS_DISABLE = 1;

    const HIDDEN_NO = 1;
    const HIDDEN_OK = 0;

    const IS_MENU_YES = 1;
    const IS_MENU_NO = 0;

    public static function getList()
    {
        return self::where('status', AdminPermission::STATUS_OK)
            ->where('hidden', AdminPermission::HIDDEN_OK)
            ->get()->toArray();
    }

}
