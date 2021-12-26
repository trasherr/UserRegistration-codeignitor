<?php

namespace App\Controllers;

class StudentDashboard extends BaseController
{
    public function index()
    {
        if (session()->has('user'))
            echo session()->get('user');
        return view('welcome_message');
    }

    public function logout(){
        if (session()->has('user')){
            session()->remove('user');
            return redirect()->to('/signin/student?access=out')->with('fail',"Logged out");
        }
    }
   
}
