<?php

namespace App\Http\Controllers;

use App\Helpers\UtilHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $name  = $request->session()->get('name');
        if (empty($name)) {
            return redirect('/user/login');
        } else {
            return redirect('/task/index');
        }
    }

    public function logout(Request $request) {
        $request->session()->flush();
        return redirect('/user/login');
    }


    public function register(Request $request)
    {
        return view('register');
    }

    public function registerStore(Request $request)
    {
        $name = $request->input('name');
        $password1 = $request->input('password1');
        $password2 = $request->input('password2');
        if (empty($password1) || empty($name) || empty($password2)) {
            return json_encode(['code' => 100, 'msg' => '参数缺失']);
        }
        if ($password1 !== $password2) {
            return json_encode(['code' => 100, 'msg' => '两次密码不一致']);
        }
        $user = DB::table('users')->where('name', $name)->first();
        if (!empty($user)) {
            return json_encode(['code' => 100, 'msg' => '用户已存在']);
        }
        $salt = UtilHelper::randCode(4);

        $newPwd = UtilHelper::hashStr($password1, $salt);
        $user = DB::table('users')->insert([
            'name' => $name,
            'salt' => $salt,
            'password' => $newPwd,
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return json_encode(['code' => 0, 'msg' => '注册成功']);
    }

    public function login(Request $request)
    {
        return view('login');
    }

    public function loginIn(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $user = DB::table('users')->where('name', $name)->first();
        if (empty($user) || $user->password !== UtilHelper::hashStr($password, $user->salt)) {
            return json_encode(['code' => 100, 'msg' => '用户不存在或密码错误']);
        }
        $request->session()->put('name', $name);
        $request->session()->put('user_id', $user->id);
        return json_encode(['code' => 0, 'msg' => '登录成功']);
    }
}
