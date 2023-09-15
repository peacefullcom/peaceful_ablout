<?php
/**
 * ClassName: MediaSet
 * 传媒网站配置模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class MediaSet extends Model
{
    /**
     * 模型表article
     * @var string
     */
    protected $table = "media_setting";

    protected $fillable = array(
        'id',
        'cate',
        'name',
        'value'
    );
    
}
