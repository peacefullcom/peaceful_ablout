<?php
/**
 * ClassName: ArticalController
 * 文章API控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\CompanyAPI;
date_default_timezone_set('America/Vancouver');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\Controller;

use App\Models\Article;

class ArticalController extends Controller
{


    function __construct()
    {

    }
    /**
     * 获取文章列表
     * @param Request $request
     * @return json
     */
    public function getArticalList() {
        $articleModel = new Article();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $articles = $query->orderBy('id', 'desc')->get()->toArray();
        return response()->json(['code' => 200, 'articles' => $articles]);
    }

    public function getArticalById($id) {
        $article = Article::find($id);
        if(!$article) {
            return response()->json([
                'code' => 400,
                'message' => 'This article does not exist.'
            ]);
        }
        $article->toArray();
        return response()->json(['code' => 200, 'data' => $article]);
    }

}