<?php
/**
 * ClassName: ArticleCategory
 * 文章分类模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ArticleCategory extends Model
{
    /**
     * 模型表article_category
     * @var string
     */
    protected $table = "article_category";

    protected $fillable = array(
        'name',
        'name_en',
        'is_publish',
        'sort'
    );
    
}
