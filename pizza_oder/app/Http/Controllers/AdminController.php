<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function changepassord() {
        return view('admin.password.changeadmin');
    }

     //change password
     public function changeadmipassword(Request $request) {
        //password change required
        //1.all fill
        //2.old password==database password
        //3.new password==confirm password need 8
        $this->passwordValidationCheck($request);
        $currentuserid =Auth::user()->id;
        $user = User::select('password')->where('id',$currentuserid)->first();
        $dbpassword = $user->password;
        if(Hash::check($request->oldpassword, $dbpassword)) {
            $data = ['password'=>Hash::make($request->newpassword)];

            User::where('id',Auth::user()->id)->update($data);

            Auth::logout();
            return redirect()->route('authloginpage');
        }
        return back()->with(['notMatch' =>'the old password is worng,try again']);
    }
    public function detail() {
        return view('admin.password.detail');
    }

    //direct page
    public function edit() {
        return view('admin.password.edit');
    }
    //update acc
    public function update($id,Request $request) {
        $this->accountValidationCheck($request);
        $data = $this -> getuserdata($request);
        //image
        if($request->hasfile('image')) {
            //old image name
            $dbimage =user::where('id',$id)->first();
            $dbimage =$dbimage->image;

            if($dbimage != null) {
                Storage::delete('public/',$dbimage);
            }
            $filename = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$filename);
            $data['image'] = $filename;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('detailpage')->with(['updateSuccess'=>'Admin updated success...']);
    }
    //admin list
    public function listpage() {

        $admin = User::where('role','admin')->paginate(3);
        return view('admin.password.list',compact('admin'));
    }

    //change admin role
    public function changerole(Request $request) {
        $datasource = [
            'role' => $request->role
        ];
       User::where('id',$request->userid)->update($datasource);
    }

    private function requestUserData($request) {
        return[
            'role'=>$request->role
        ];
    }
    private function getuserdata($request) {
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'phone'=>$request->phone,
            'address'=>$request->address
        ];
    }

    //acc validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required',
        ])->validate();
    }

    private function passwordValidationCheck($request) {
        Validator::make($request->all(),[
            'oldpassword'=>'required | min:6',
            'newpassword'=>'required | min:6',
            'confirmpassword'=>'required | min:6 |max:10| same:newpassword',
        ],[
            'oldpassword.required'=>'wrong password,please try again',
            'newpassword.required'=>'wrong password,please try again',
            'confirmpassword.required'=>'wrong password,please try again',

        ])->validate();
    }
}
