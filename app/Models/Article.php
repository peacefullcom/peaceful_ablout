<?php
/**
 * ClassName: Article
 * 文章模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Article extends Model
{
    /**
     * 模型表article
     * @var string
     */
    protected $table = "article";

    protected $fillable = array(
        'title',
        'content',
        'img',
        'is_publish',
        'is_delete',
        'sort'
    );
    
}
