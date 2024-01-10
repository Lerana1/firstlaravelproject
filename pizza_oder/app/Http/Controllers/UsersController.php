<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function role() {
        $users = User::where('role','user')->paginate(3);
        return view('admin.layouts.role',compact('users'));
    }
    //change role
    public function changerole(Request $request) {
        $datasource = [
            'role' => $request->role
        ];
       User::where('id',$request->userid)->update($datasource);
    }
}
