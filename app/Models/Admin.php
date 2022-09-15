<?php
/**
 * ClassName: Admin
 * 后台管理员模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;

class Admin extends User 
{
    /**
     * 模型表article_category
     * @var string
     */
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $guard = "admin";
    protected $fillable = array(
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'remember_token',
        'group_id',
        'is_active',
    );

    protected $guarded = array('id');
    public $timestamps = true;
}
?>