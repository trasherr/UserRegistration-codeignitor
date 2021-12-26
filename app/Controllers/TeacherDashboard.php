<?php

namespace App\Controllers;

class TeacherDashboard extends BaseController
{
    public function index()
    {
        if (session()->has('tuser'))
            echo session()->get('tuser');
        return view('welcome_message');
    }

    public function logout(){
        if (session()->has('tuser')){
            session()->remove('tuser');
            return redirect()->to('/signin/teacher?access=out')->with('fail',"Logged out");
        }
    }
   
}
