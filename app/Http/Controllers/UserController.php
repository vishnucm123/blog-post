<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $users = User::paginate(5);

        $user = auth()->user();

        return view('dashboard.users.users', compact(
            'users',
            'user',
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::findOrFail($id);

        return view('dashboard.users.users_card', compact(
            'user',
        ));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $input = $request->all();



        // $this->validate($request,
        // [
        //     'password' => 'required|confirmed|min:6',
        // ]);

        $user = Auth::user();

        if ($file = $request->file('picture')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('storage/images', $name);

            $input['picture'] = $name;

            $input['random'] = 'no-picture';

        }

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        } else {
            $input['password'] = auth()->user()->password;
        }

        $user->whereId($id)->first()->update($input);

        session()->flash('success-profile', 'You successfully updated your profile!');

        return back();

    }


    public function settings() {


        $user = auth()->user();

        return view('dashboard.users.users_settings', compact(
            'user',
        ));

    }
}
