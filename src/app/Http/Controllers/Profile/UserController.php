<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles'])->get();
        // $users = DB::table('users')
        // ->join('users_roles', 'users.id', '=', 'users_roles.user_id')
        // ->join('users_permissions', 'users.id', '=', 'users_permissions.user_id')
        // ->get();

        return view('pages.profile.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::select('name', 'id')->get();
        $permissions = Permission::select('name', 'id')->get();

        return view('pages.profile.users.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $role = Role::find($request['role']);
        $permissions = Permission::find($request['permissions']);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->account = $request['account'];
        $user->status = $request['status'];
        $user->phone = $request['phone'];
        $user->telegram_username = $request['telegram_username'];

        $user->save();

        if (!$user->save()) {
            return redirect()->back()->with('error', 'User dont created successfully.');
        }

        $user->roles()->attach($role);

        $user->permissions()->attach($permissions);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.profile.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::select('name', 'id')->get();
        $permissions = Permission::select('name', 'id')->get();

        return view('pages.profile.users.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $role = Role::find($request['role']);
        $permissions = Permission::find($request['permissions']);

        $user->name = $request['name'];
        $user->email = $request['email'];

        if (null != $request['password']) {
            $user->password = Hash::make($request['password']);
        }

        $user->password = $user->password;
        $user->account = $request['account'];
        $user->status = $request['status'];
        $user->phone = $request['phone'];
        $user->telegram_username = $request['telegram_username'];

        $user->update();

        if (!$user->update()) {
            return redirect()->back()->with('error', 'User dont updated successfully.');
        }

        $user->roles()->sync($role);

        $user->permissions()->sync($permissions);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return redirect()->route('users.index')->refresh()->with('success', 'User deleted.');
    }
}
