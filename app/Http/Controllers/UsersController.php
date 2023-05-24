<?php

namespace App\Http\Controllers;

use DB;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


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
            'credits' => 'required|string|max:255',
        ]);

        $item = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'credits' => $request->credits,
        ];

        DB::table('users')->where('id', Auth::id())->update($item);      

        return redirect('/users')->with('status','User updated successfully');
    }

    public function edit() {
        return view('users.edit');
    }

 
    public function show() {
        return view('users.show');
    }

    public function deleteuser() {

        $user = Auth::user();
        Auth::logout();
        $user->delete();
        
        return redirect('/');
    }
}
