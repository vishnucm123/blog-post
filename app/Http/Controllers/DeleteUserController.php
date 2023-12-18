<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{

    public function multipleusersdelete(Request $request)

    {
        $id = $request->id;

        foreach ($id as $user)
        {
            User::where('id', $user)->delete();

            $auth_user = auth()->user()->id;

            Post::where('user_id', $user)->update(['user_id' => $auth_user]);

        }

        session()->flash('success-user-deleted', 'User deletion was successful!!');

        return back();

    }
}
