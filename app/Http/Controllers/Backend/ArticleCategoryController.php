<?php
/**
 * ClassName: ArticleCategoryController
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
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{  
    public function __construct()
    {  
         
    }

    /**
     * 文章分类列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $articleCategoryModel = new ArticleCategory();
        $query = $articleCategoryModel->query();
        $query->where('is_delete', '=', 0);
        $articleCategories = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.article_category.index')->with('articleCategories', $articleCategories);
    }

    /**
     * 创建文章分类
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'name_en' => 'required|string|max:25',
                'sort' => 'integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $id = ArticleCategory::create([
                'name' => $request->get('name'),
                'name_en' => $request->get('name_en'),
                'is_publish' => $request->get('is_publish') == 'on' ? 1 : 0,
                'sort' => $request->get('sort'),
            ])->id;
            if($id) {
                return Redirect::route('article-category')->with(['message' => 'Created a new article category successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new article category .']);
            }
        }
        return view('backend.article_category.create');
    }

    /**
     * 修改文章分类
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $articleCategory = ArticleCategory::find($id);
        if(!$articleCategory) {
            return Redirect::back()->with('message', 'This articleCategory does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'name_en' => 'required|string|max:25',
                'sort' => 'integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $articleCategory->name = $request->get('name');
            $articleCategory->name_en = $request->get('name_en');
            $articleCategory->is_publish = $request->get('is_publish') == 'on' ? 1 : 0;
            $articleCategory->sort = $request->get('sort');
           if(!$articleCategory->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this articleCategory.']);
           }   
           return Redirect::back()->with(['message' => 'Update articleCategory successfuly.']);
        }
        return view('backend.article_category.edit',compact('articleCategory'));
    }

    /**
     * 删除文章分类
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        $articleCategory = ArticleCategory::find($id);
        if(!$articleCategory) {
            return Redirect::back()->with('message', 'This articleCategory does not exist.');
        }

        $articleCategory->is_delete = 1;
        $articleCategory->deleted_at = date('Y-m-d H:i:s', time());

        if(!$articleCategory->save()){
            return Redirect::back()->withErrors(['message' => 'Failed to delete this articleCategory.']);
        }   
        return Redirect::back()->with(['message' => 'Delete articleCategory successfuly.']);
    }

}