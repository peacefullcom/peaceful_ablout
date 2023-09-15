<?php
/**
 * ClassName: MediaAuthorController
 * 文章作者控制器
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
use App\Models\MediaAuthor;

use App\Library\ImageUpload;

class MediaAuthorController extends Controller
{  
    private $prefixName = 'media_author';

    public function __construct()
    {  
         
    }

    /**
     * 作者列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $authorModel = new MediaAuthor();
        $query = $authorModel->query();
        $authors= $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.media_author.index')->with('authors', $authors);
    }

    /**
     * 创建作者
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request, ImageUpload $uploader)
    {
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'title' => 'required|string|max:25',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $id = MediaAuthor::create([
                'title' => $request->get('title'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ])->id;
            if($id) {
                return Redirect::route('author')->with(['message' => 'Created a new author successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new author .']);
            }
        }
        return view('backend.media_author.create');
    }

    /**
     * 修改作者
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, ImageUpload $uploader, $id)
    {
        $author = MediaAuthor::find($id);
        if(!$author) {
            return Redirect::back()->with('message', 'This author does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'title' => 'required|string|max:25',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            
            $author->name = $request->get('name');
            $author->title = $request->get('title');
            $author->description = $request->get('description');

           if(!$author->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this author.']);
           }   
           return Redirect::back()->with(['message' => 'Update author successfuly.']);
        }
        return view('backend.media_author.edit',compact('author'));
    }

}