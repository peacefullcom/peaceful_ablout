<?php
/**
 * ClassName: ArticleController
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
        $articleModel = new Article();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $query->where('is_publish', '=', 1);
        $articles = $query->orderBy('id', 'desc')->get()->toArray();
        return response()->json(['code' => 200, 'articles' => $articles]);
    }

    public function getTest() {
        $s = "abbaca";
        $count = strlen($s);
        $hash = [];
        for ($i = 0; $i < $count; $i++) {
            if (isset($hash[$s[$i]])) {
                $s[$i] = '-';
                $s[$hash[$s][$i]] = '-';
                unset($hash[$s[$i]]);
            } else {
                $hash[$s[$i]] = $i;
            }
        }
        return $s;
    }


    public function getTest0() {
        $start = "AGCCGGTT";
        $end = "TCCCGGTT";
        $bank = ["CGCCGGTT", "GGCCGGTT", "TGCCGGTT", "TCCCGGTT"];

        // 如果前后序列一致那么直接返回0
        if($start==$end)return 0;
        // 如果bank数组是空那么返回-1 无需转换
        if(count($bank)==0)return -1;
        // 判断最后结果是否存在,不存在返回-1
        $bank_hash = array_flip($bank);
        if(!isset($bank_hash[$end]))return -1;

        // 将start 当作第一个变换序列加入到队列中
        $queue = [$start];
        // 标记当前序列访问过
        $visited[$start] = true;
        $level = 0;
        // 当队列不为空时保持循环
        while ($queue) {
            $size = count($queue);
            while ($size--) {
                // 弹出队列头部序列进行处理
                $curr = array_shift($queue);
                // 如果该序列等于结果序列那么返回次数
                if ($curr == $end) return $level;
                // 变化序列的每个字母达成新的序列
                // curr : AACCGGTT
                for ($i = 0, $len = strlen($curr); $i < $len; $i++) {
                    // old:A
                    $old = $curr[$i];
                    foreach (['A', 'C', 'G', 'T'] as $char) {
                        // 这里增加判断只变化3次
                        if($curr[$i] != $char){
                            $curr[$i] = $char;
                            // curr: CACCGGTT
                            //       GACCGGTT
                            //       TACCGGTT
                            // 如果新生成的序列不在访问队列里且在最终结果队列中存在
                            // 代表是一个未处理的有效序列
                            if (!isset($visited[$curr]) && isset($bank_hash[$curr])) {
                                // 那么将新生成的有效序列推入待处理序列
                                // 且标记为已访问
                                $queue[] = $curr;
                                $visited[$curr] = true;
                            }
                        }
                    }
                    // 将处理的序列还原
                    $curr[$i] = $old;
                }
            }
            // 每处理一个有效队列代表变换了一次
            $level += 1;
        }
        return -1;
    }

    /**
     * 获取文章列表
     * @param Request $request
     * @return json
     * 
     */
    public function getArticleListByCid($cid) {
        $articleModel = new Article();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $query->where('is_publish', '=', 1);
        $query->where('cid', '=', $cid);
        $articles = $query->orderBy('id', 'desc')->get()->toArray();
        return response()->json(['code' => 200, 'articles' => $articles]);
    }


    /**
     * 获取文章内容
     * @param Request $request
     * @return json
     */
    public function getArticleById($id) {
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