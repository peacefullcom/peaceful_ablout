<?php
/**
 * ClassName: ArticleCategoryController
 * 文章分类API控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\CompanyAPI;
date_default_timezone_set('America/Vancouver');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\Controller;

use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{


    function __construct()
    {

    }
    /**
     * 获取文章分类列表
     * @param Request $request
     * @return json
     */
    public function getArticleCategoryList() {
        $articleCategoryModel = new ArticleCategory();
        $query = $articleCategoryModel->query();
        $query->where('is_delete', '=', 0);
        $articleCategory = $query->orderBy('id', 'desc')->get()->toArray();  
        return response()->json(['code' => 200, 'data' => $articleCategory]);
    }

}