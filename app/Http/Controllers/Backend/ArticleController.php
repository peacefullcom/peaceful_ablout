<?php
/**
 * ClassName: ArticleController
 * 文章分类控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;
use App\Models\Article;

class ArticleController extends Controller
{  
    public function __construct()
    {  
         
    }

    /**
     * 文章列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $articleModel = new Article();
        $query = $articleModel->query();
        $query->where('is_delete', '=', 0);
        $articles = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.article.index')->with('articles', $articles);
    }

    /**
     * 创建文章
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'sort' => 'integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $id = Article::create([
                'title' => $request->get('title'),
                'cid' => $request->get('cid'),
                'content' => $request->get('content'),
                'is_publish' => $request->get('is_publish') == 'on' ? 1 : 0,
                'sort' => $request->get('sort'),
            ])->id;
            if($id) {
                return Redirect::route('article')->with(['message' => 'Created a new article successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new article .']);
            }
        }
        return view('backend.article.create');
    }

    /**
     * 修改文章
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $article = Article::find($id);
        if(!$article) {
            return Redirect::back()->with('message', 'This article does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'sort' => 'integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $article->title = $request->get('title');
            $article->cid = $request->get('cid');
            $article->content = $request->get('content');
            $article->is_publish = $request->get('is_publish') == 'on' ? 1 : 0;
            $article->sort = $request->get('sort');
           if(!$article->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this article.']);
           }   
           return Redirect::back()->with(['message' => 'Update article successfuly.']);
        }
        return view('backend.article.edit',compact('article'));
    }

    /**
     * 删除文章
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        $article = Article::find($id);
        if(!$article) {
            return Redirect::back()->with('message', 'This article does not exist.');
        }

        $article->is_delete = 1;
        $article->deleted_at = date('Y-m-d H:i:s', time());

        if(!$article->save()){
            return Redirect::back()->withErrors(['message' => 'Failed to delete this article.']);
        }   
        return Redirect::back()->with(['message' => 'Delete article successfuly.']);
    }

}