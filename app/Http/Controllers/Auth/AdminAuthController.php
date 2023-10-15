<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function adminLogin() {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Login with user
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function postAdminLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admin')-> attempt($request->only(['username','password']), $request->get('remember'))){
            return redirect()->route('admin.dashboard');
        }
        return back()->with('message', 'Username or password is incorrect');
    }


     /**
     *  logout user
     *
     * @return RedirectResponse
     */
    public function logout() {      
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
