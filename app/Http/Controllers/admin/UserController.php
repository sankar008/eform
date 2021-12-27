<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use App\Models\admin\Company;
use Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login(Request $request) {
        if($request -> method() =='GET') {
            return view('admin/login');
        }
        else if($request -> method() == 'POST') {
            
            $request -> validate([
                'email' => 'required|email',
                'pwd' => 'required'

            ]);

            $loginData = Admin::where(['email' => $request->input('email')])->first();
            
            $data = Company::where('id', $request->id) ->first();
            if($loginData != '') {
                if($request -> pwd == $loginData['pwd']){
                     
                    $request -> session() -> put('loginStatus', true);
                    $request -> session() -> put('loginId', $loginData['id']);
                    $request -> session() -> put('email', $loginData['email']);
                    $request->session() -> put('name', $loginData['name']);
                    $request->session() -> put('image', $loginData['image']);
                    //$request->session() -> put('com_logo',$data['image']);
                   
                    return redirect::to('admin/dashboard');
                }else{
                    return redirect::to('/')->with('errmsg', "Your Password Not Valid");   
                }
            }else {
                return redirect::to('/')->with('errmsg', "Your Email Id Not Valid"); 
            }         

        }
    }

    public function dashboard(Request $request) {
        return view('admin/dashboard');
    }

    public function logout() {
        Session :: flush();
        return redirect :: to('/');
    }
        
}

