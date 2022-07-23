<?php

declare (strict_types=1);
namespace App\Model;

use Qbhy\HyperfAuth\AuthAbility;
use Qbhy\HyperfAuth\Authenticatable;

class AdminUser extends Model implements Authenticatable
{
    use AuthAbility;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];



}
