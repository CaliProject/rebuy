<?php

namespace Rebuy\Http\Controllers;

use Rebuy\User;
use Illuminate\Http\Request;
use Rebuy\Library\Traits\APIResponse;

class ProfileController extends Controller {

    use APIResponse;

    /**
     * Show index page.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the profile page.
     * 
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($name)
    {
        $user = User::getUserByName($name);
        
        return view('profile.show', compact('user'));
    }

    /**
     * Updates user's profile.
     * 
     * @param Request $request
     * @return array
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'tel'   => 'required|unique:users,tel,' . $user->id,
        ]);

        $attributes = $request->except(['_token', '_method', 'password', 'password_confirmation']);

        if ($request->input('password') !== '') {
            $this->validate($request, [
                'password' => 'min:6|confirmed'
            ]);

            $user->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }

        $user->update($attributes);

        return $this->successResponse('用户资料更新成功');
    }
}
