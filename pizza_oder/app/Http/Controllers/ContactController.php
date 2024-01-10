<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contact page
    public function contactpage() {
        return view('user.contact.contant');
    }

    public function contactuserpage(Request $request ) {
        $datas =$this -> getdata($request);
        Contact::create($datas);
        return back();
    }

    private function getdata($request) {
        return [
            'name' => $request ->username,
            'email' => $request -> useremail,
            'message'=>$request->subject
        ];
    }
}
