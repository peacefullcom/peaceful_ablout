<?php
/**
 * ClassName: HomeController
 * 后台首页控制器
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

class HomeController extends Controller
{  
    
    public function __construct()
    {  
         
    }
    /**
     * 后台首页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return view('backend.home.index');
    }

    /**
     * 管理员退出登录
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request){
        Session::flush();
        Auth::guard('admin')->logout();
        return Redirect::to("/backend");
    }

    /**
     * 修改管理员个人信息
     * @param Request $request
     * @return mixed
     */
    public function changeProfile(Request $request)
    {
        if($request->has('submit')){
            $validator = Validator::make($request->all(),[
                'username' => 'required',
                'last_name'  =>  'required',
                'first_name' => 'required',
                'phone' => 'required|min:10'
            ]);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Admin::where('id', Auth::guard('admin')->user()->id)
                ->update(array('username' => $request->get('username'),
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'phone' => preg_replace('/[^0-9]/', '', $request->get('phone'))
                )); 
                return Redirect::back()->with('success',1);
            }
        }
        $row = Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('backend.home.change_profile',array('row' => $row));
    }

    /**
     * 修改管理员密码
     * @param Request $request
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        if($request->has('submit')){
            $validator = Validator::make($request->all(),[
                    'old_password' => 'required',
                    'password'  =>  'required|min:8',
                    'password_confirm' => 'required|same:password'
                     
            ]);
            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
                if(Hash::check($request->input('old_password'), $admin->password)){
                    $password = trim($request->input('password'));
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(array('password' => Hash::make($password)));
                    return Redirect::back()->with('success', 'Updated Successfully!');
                }
                return Redirect::back()->with('failure', 'Old password is not correct');
            }
        }
        return view('backend.home.change_password');
    }

}