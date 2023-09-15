<?php
/**
 * ClassName: MediaArticleCategory
 * 文章分类模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class MediaArticleCategory extends Model
{
    /**
     * 模型表article_category
     * @var string
     */
    protected $table = "media_article_category";

    protected $fillable = array(
        'name',
        'name_en',
        'is_publish',
        'sort'
    );

    public function getArticleCategorySelection() {
        $data = self::where('is_publish', '=', 1)->where('is_delete', '=', 0)->select(['id', 'name'])->get()->toArray();
        $res = [];
        foreach ($data as $cate) {
            $res[$cate['id']] = $cate['name'];
        }
        return $res;
    }
    
}
