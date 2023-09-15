<?php
/**
 * ClassName: MediaSetController
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
use App\Models\MediaSet;

use App\Library\ImageUpload;

class MediaSetController extends Controller
{  
    private $prefixName = 'media_picture';

    public function __construct()
    {  
         
    }

    /**
     * 网站介绍配置
     * @param Request $request
     * @return mixed
     */
    public function descriptionSet(Request $request)
    {

        $mediaSet = MediaSet::where('name', '=', 'description')->first();
        $data = (json_decode($mediaSet->value, true));
        if(!$data) {
            return Redirect::back()->with('message', 'This descriptionSet does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'description' => 'required|string|max:255',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $data['title'] = $request->get('title');
            $data['description'] = $request->get('description');
            $mediaSet->value = json_encode($data);

           if(!$mediaSet->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this description.']);
           }   
           return Redirect::back()->with(['message' => 'Update description successfuly.']);
        }
        return view('backend.media_set.description',compact('data'));
    }

    public function headInfoSet(Request $request)
    {

        $mediaSet = MediaSet::where('name', '=', 'info')->first();
        $data = (json_decode($mediaSet->value, true));
        if(!$data) {
            return Redirect::back()->with('message', 'This descriptionSet does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'content' => 'required|string|max:255',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $data['title'] = $request->get('title');
            $data['content'] = $request->get('content');
            $mediaSet->value = json_encode($data);

           if(!$mediaSet->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this description.']);
           }   
           return Redirect::back()->with(['message' => 'Update description successfuly.']);
        }
        return view('backend.media_set.headinfo',compact('data'));
    }

    public function contactSet(Request $request)
    {

        $mediaSet = MediaSet::where('name', '=', 'contact')->first();
        $data = (json_decode($mediaSet->value, true));
        if(!$data) {
            return Redirect::back()->with('message', 'This contact does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'twitter' => 'string|max:255',
                'facebook' => 'string|max:255',
                'instagram' => 'string|max:255',
                'pinterest' => 'string|max:255',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $data['twitter'] = $request->get('twitter');
            $data['facebook'] = $request->get('facebook');
            $data['instagram'] = $request->get('instagram');
            $data['pinterest'] = $request->get('pinterest');
            $mediaSet->value = json_encode($data);

           if(!$mediaSet->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this contact.']);
           }   
           return Redirect::back()->with(['message' => 'Update contact successfuly.']);
        }
        return view('backend.media_set.contact',compact('data'));
    }


}