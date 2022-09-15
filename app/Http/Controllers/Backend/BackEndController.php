<?php
/**
 * ClassName: BackEndController
 * 后台登录控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class BackEndController extends Controller
{
    function __construct()
    {

    }
    
    /**
     * 后台登录页
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return view('backend.backend.index');
    }

    /**
     * 后台登录操作
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        if($request->has('submit')){
            $email = trim($request->get('email'));
            $password = trim($request->get('password'));
            $guards = ['email' => $email, 'password' => $password, 'is_active' => 1];
            if( Auth::guard('admin')->attempt($guards) ) {
                Session::put('email',$email);
                Session::put('id',Auth::guard('admin')->user()->id);
                Session::put('username',Auth::guard('admin')->user()->username);
                Session::save();
                return  Redirect::to('/backend/home');
            } else {
                return Redirect::to("/backend/login")->with('loginResult',"Failed to login");
            }
        }
        return view('backend.backend.login');
    }
}