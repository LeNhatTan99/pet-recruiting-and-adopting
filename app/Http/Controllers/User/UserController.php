<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showProfile() {
        $user = Auth::user();
        $data = [
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
        ];
        return view('users.profile.index', compact('data'));
    }

    public function editProfile(RegisterRequest $request, $username) {
        Log::info('đang cập nhật');
        try {
            $user = User::where('username', $username)->first();
            DB::beginTransaction();
            $params = $request->only([
                'username',
                'first_name',
                'last_name',
                'phone_number',
                'email',
                'address',
            ]);
            if(!empty($request->password)) {
                $params['password'] = Hash::make($request->password);
            }

            $data = $user->update($params);
            DB::commit();
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Profile updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('[UserController][editProfile] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update profile']);
        }
    }

}
