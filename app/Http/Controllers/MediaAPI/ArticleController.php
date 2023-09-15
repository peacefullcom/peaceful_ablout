<?php


/**
 * ClassName: ArticleController
 * 文章API控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\MediaAPI;
date_default_timezone_set('America/Vancouver');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\Controller;

use App\Models\MediaArticle;

class ArticleController extends Controller
{

    function __construct()
    {

    }

    /**
     * 获取文章列表
     * @param Request $request
     * @return json 
     */
    public function getArticleList() {
        $articleModel = new MediaArticle();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $query->where('is_publish', '=', 1);
        $articles = $query->orderBy('id', 'desc')->limit(4)->get()->toArray();
        return response()->json(['code' => 200, 'articles' => $articles]);
    }

    /**
     * 获取文章列表
     * @param Request $request
     * @return json 67
     */
    public function getArticleListByCid($cid) {
        $articleModel = new MediaArticle();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $query->where('is_publish', '=', 1);
        $query->where('cid', '=', $cid);
        $articles = $query->orderBy('id', 'desc')->get()->toArray();
        return response()->json(['code' => 200, 'articles' => $articles]);
    }

    public function getArticleTest() {
        if (!$root) return [];
        $queue = [];
        array_push($queue, $root);
        $ans = [];
        while (!empty($queue)) {
            $arr = [];
            foreach ($queue as $v) {
                $info = array_shift($queue);
                $arr[] = $info->val;
                if ($info->left != null) array_push($queue, $info->left);
                if ($info->right != null) array_push($queue, $info->right);
            }
            array_push($ans, $arr);
        }

    }





    /**
     * 获取文章内容
     * @param Request $request
     * @return json
     */
    public function getArticleById($id) {
        $article = MediaArticle::find($id);
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