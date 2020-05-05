<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class AdminController extends Controller
{
    //
    public function getAdminDashboard(){
    	return view('admin.layouts.dashboard');
    }

    public function getAdminLogin(){
    	return view('admin_login');
    }

    public function postAdminLogin(Request $request){
    	$this->validate($request , 
    		[
    			'admin_email'	 => 'required | email',
    			'admin_password' =>	'required | min:6 | max:50',
    		] , 
    		[
    			'admin_email.required'		=>	'Bạn chưa nhập email',
    			'admin_email.email'			=>	'Bạn chưa nhập đúng định dạng email',

    			'admin_password.required'	=>	'Bạn chưa nhập mật khẩu',
    			'admin_password.min'		=>	'Mật khẩu phải có ít 6 kí tự',
    			'admin_password.max'		=>	'Mật khẩu có độ dài tối đa là 50 kí tự',
    		]);

    	$admin_email 	= $request->admin_email;
    	$admin_password = $request->admin_password;
        if (Auth::attempt(['email' => $admin_email , 'password' => $admin_password])) {
            return redirect('admin/dashboard');
        }else{
            return redirect('/admin-login')->withErrors('Tài khoản hoặc mật khẩu không chính xác');
        }	
    }

    public function getAdminLogout(){
    	Auth::logout();
    	return redirect('/admin-login');
    }
}
