<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Flash;
use App\User;
use Auth;

class ProfileController extends Controller
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

        Flash::success('Item updated successfully.');

        return redirect('/profile');
    }

    public function edit() {
        return view('profile.edit');
    }

    public function show() {
        return view('profile.show');
    }
}
