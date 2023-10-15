<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AnimalCasesController extends Controller
{
     /**
     * @var array $genders
     * @var array $ages
     */
    protected $genders;
    protected $ages;

    public function __construct( Animal $animal) {
        $this->genders = [
            Animal::MALE => 'Male',
            Animal::FEMALE => 'Female',
        ];
        $this->ages = [
            Animal::AGE_LESS_THAN_1 => 'Less than 1 years old',
            Animal::AGE_1_TO_2 => '1 to 2 years old',
            Animal::AGE_2_TO_5 => '2 to 5 years old',
            Animal::AGE_5_TO_10 => '5 to 10 years old',
            Animal::AGE_MORE_THAN_10 => 'More than 10 years old',
        ];
    }
    public function index(Request $request) {
        $genders = $this->genders;
        $ages = $this->ages;
        $datas = Animal::query();     
        $datas = $datas->paginate(10);
        return view('admin.animals.index', compact('datas', 'genders', 'ages'));
    }

    public function editProfile(RegisterRequest $request, $username) {
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
