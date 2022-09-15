<?php
/**
 * ClassName: SystemAccountController
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

class SystemAccountController extends Controller
{  
    public function __construct()
    {  
         
    }

    /**
     * 后台账号列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $adminModel = new Admin();
        $query = $adminModel->query();
        $systemAccounts = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.system_account.index')->with('systemAccounts', $systemAccounts);
    }

    /**
     * 创建后台账号
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        if($request->has('submit')) {
            $validator = $request->validate( [
                'username' => 'required|string|max:25',
                'first_name' => 'required|string|max:25',
                'last_name' => 'required|string|max:25',
                'email' => 'required|email|max:100|unique:admin',
                'password' => 'required|string|min:8',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $id = Admin::create([
                'username' => $request->get('username'),
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'is_active' => $request->get('is_active') == 'on' ? 1 : 0
            ])->id;
            if($id) {
                return Redirect::route('system-account')->with(['message' => 'Created a new system account successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new system account.']);
            }
        }
        return view('backend.system_account.create');
    }

    /**
     * 修改后台账号
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $admin = Admin::find($id);
        if(!$admin) {
            return Redirect::back()->with('message', 'This system account does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'username' => 'required|string|max:25',
                'first_name' => 'required|string|max:25',
                'last_name' => 'required|string|max:25',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $admin->username = $request->get('username');
            $admin->first_name = $request->get('first_name');
            $admin->last_name = $request->get('last_name');
            $admin->phone = $request->get('phone');
            if($request->get('password')) {
               $row->password = Hash::make($request->get('password'));
            }
            $admin->is_active = $request->get('is_active') == 'on' ? 1 : 0;
           if(!$admin->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this system account.']);
           }   
           return Redirect::back()->with(['message' => 'Update system account successfuly.']);
        }
        return view('backend.system_account.edit',compact('admin'));
    }

    /**
     * 删除后台账号
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        $admin = Admin::find($id);
        if(!$admin) {
            return Redirect::back()->with('message', 'This system account does not exist.');
        }
        $admin->is_delete = 1;
        $admin->deleted_at = date('Y-m-d H:i:s', time());
        if(!$admin->save()){
            return Redirect::back()->withErrors(['message' => 'Failed to delete this system account.']);
        }   
        return Redirect::back()->with(['message' => 'Delete system account successfuly.']);
    }

}