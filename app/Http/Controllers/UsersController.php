<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\User;
use Auth;


class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function update(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $item = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ];

        DB::table('users')->where('id', Auth::id())->update($item);
        

        return redirect('/users')->withSuccess('User updated successfully');
    }

    public function edit() {
        return view('users.edit');
    }

   /* public function show($id) {
        $profile = Profile::find($id);
        $this->authorize('show', $profile);
        return view('profile.show', ['profile' => $profile]);
        
    }*/
    public function show() {
        return view('users.show');
    }
}
