<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountUpdateRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $user = auth()->user();

        return view('pages.profile.account.show', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit()
    {
        $user = auth()->user();

        return view('pages.profile.account.edit', compact('user'));
    }

    /**
     * @param AccountUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AccountUpdateRequest $request)
    {
        $user = auth()->user();
        $user->name = $request['name'];
        $user->email = $request['email'];

        if (null != $request['password']) {
            $user->password = Hash::make($request['password']);
        }

        $user->phone = $request['phone'];
        $user->telegram_username = $request['telegram_username'];
        $user->update();

        if (!$user->update()) {
            return redirect()->back()->with('error', 'Account dont updated successfully.');
        }

        return back()->with('success', 'Account updated successfully.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();
        return redirect()->route('login')->with('success', 'Account updated successfully.');
    }

}
