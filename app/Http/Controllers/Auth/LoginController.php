<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Designer : 畑
 * Date     : 2021/06/14
 * Purpose  : C?-1 認証処理
 */

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Function Name : username
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 認証に利用するデータを指定
     * Return        : カラム名
     */
    public function username()
    {
         return 'student_number';
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
