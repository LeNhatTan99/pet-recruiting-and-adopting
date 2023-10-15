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

class AuthController extends Controller
{
    public function register() {
        if (Auth::guard('web')->check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }
    public function postRegister(RegisterRequest $request) {
        try {
            DB::beginTransaction();
            $data = [
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ];
            User::create($data);
            DB::commit();
            return redirect()->route('login')->with(['success' => 'Register successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("error register". $e->getMessage());
            return redirect()->back()->with(['error' => 'Register false']);
        }
    }

    public function login() {
        if (Auth::guard('web')->check()) {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    /**
     * Login with user
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username'   => 'required',
            'password' => 'required|min:6'
        ]);
        if (Auth::attempt($request->only(['username','password']), $request->get('remember'))){
            return redirect()->route('home');
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
        return redirect()->route('login');
    }
}
