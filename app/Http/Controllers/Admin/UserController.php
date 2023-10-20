<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
        /**
    * view index list type
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
    */
    public function index(Request $request) {
        $datas = User::query();
        if(isset($request->search)) {
            $searchTerm = $request->search;
            $datas->where(function ($query) use ($searchTerm) {
                $query->where('username', 'like', '%' . $searchTerm . '%')
                    ->orWhere('first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('phone_number', 'like', '%' . $searchTerm . '%');
            });
        }   
        $datas = $datas->paginate(10);
        return view('admins.user.index', compact('datas'));
    }

    /**
    * view create type
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
    */
    public function create()
    {
        return view('admins.user.create');
    }

    /**
     * store user
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $params = $request->only([
                'username',
                'email',
                'first_name',
                'last_name',
                'phone_number',
                'address',
            ]);
            $params['password'] = Hash::make($request->password);
            User::create($params);
            DB::commit();
            return redirect()->route('create.user')->with(['success' => 'Create user successfully']);
        } catch (\Exception $e) {
            Log::error('[UserController][store] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed to create user']);
        }
    }

     /**
    * view edit user
    * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|View
    */
    public function edit($id)
    {
        $data = User::find($id);
        return view('admins.user.edit', compact('data'));
    }

    /**
     * store type
     * @param StoreUserRequest $request
     * @param $id
     * @return void
     */
    public function update(StoreUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = User::find($id);
            $params = $request->only([
                'username',
                'email',
                'first_name',
                'last_name',
                'phone_number',
                'address',
            ]);
            if(isset($request->password)) {
                $params['password'] = Hash::make($request->password);
            }
            $data->update($params);
            DB::commit();
            return redirect()->route('admin.user')->with(['success' => 'Update user successfully']);
        } catch (\Exception $e) {
            Log::error('[UserController][update] error ' . $e->getMessage());
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Failed to update user']);
        }
    }

      /**
     * delete user
     * @param $id
     * @return void
     */
    public function delete($id) {
        try {
            DB::beginTransaction();
            $data = User::find($id);
            $data->delete();
            DB::commit();
            return response()->json([
                'data' => $data,
                'success' => true,
                'message' => 'Delete user successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('[UserController][Delete] error ' . $e->getMessage());
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete user']);
        }
    }

}
