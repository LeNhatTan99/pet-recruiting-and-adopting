<?php

namespace App\Http\Controllers\Web;

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
    /**
     * Display the user's profile information.
     *
     * @return \Illuminate\View\View Returns a view displaying the user's profile data.
     */
    public function showProfile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Create an array with user profile data
        $data = [
            'username' => $user->username,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone_number' => $user->phone_number,
            'address' => $user->address,
        ];

        // Return a view with the user's profile data
        return view('users.profile.index', compact('data'));
    }

    /**
     * Edit and update the user's profile information.
     *
     * @param RegisterRequest $request The Request object containing user input for updating the profile.
     * @param string $username The username of the user whose profile is being updated.
     *
     * @return \Illuminate\Http\JsonResponse Returns a JSON response indicating the success or failure of the profile update.
     */
    public function editProfile(RegisterRequest $request, $username)
    {
        Log::info('Updating profile');
        try {
            // Find the user by their username
            $user = User::where('username', $username)->first();

            // Begin a database transaction
            DB::beginTransaction();

            // Extract and validate input parameters for updating the profile
            $params = $request->only([
                'username',
                'first_name',
                'last_name',
                'phone_number',
                'email',
                'address',
            ]);

            // Update the password if provided in the request
            if (!empty($request->password)) {
                $params['password'] = Hash::make($request->password);
            }

            // Update the user's profile with the provided parameters
            $data = $user->update($params);

            // Commit the database transaction
            DB::commit();

            // Return a JSON response indicating a successful profile update
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Profile updated successfully'
            ]);
        } catch (\Exception $e) {
            // Log any error that occurs during the profile update
            Log::error('[UserController][editProfile] error ' . $e->getMessage());

            // Roll back the database transaction in case of an error
            DB::rollBack();

            // Return a JSON response indicating a failed profile update
            return response()->json(['success' => false, 'message' => 'Failed to update profile']);
        }
    }
}
