<?php

namespace App\Controllers;

class Signin extends BaseController{

    protected $helpers = ['url','form'];

    public function student(){

        $validation = $this->validate([
            
            'username' => ['rules' => 'required|min_length[3]|max_length[20]|is_not_unique[users.username]', 
                            'errors' =>['required'=> ' ',
                                        'min_length' => 'Min 3 Characters',
                                        'max_length' => 'Max 20 Characters',
                                        'is_not_unique' => 'Username not found'
                                        ]
                        ],
            'password' => ['rules' => 'required|min_length[6]|max_length[50]', 
                'errors' =>['required'=> '',
                            'min_length' => 'Min 6 Characters',
                            'max_length' => 'Max 50 Characters'
                            ]
            ]
        ]);

        if (! $validation){
            echo view('login/header', ['validation' => $this->validator]);
            echo view('login/st_login');
            echo view('login/footer');
        }
        else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $userModel = new \App\Models\UserModel();
            $userInfo = $userModel->where('username',$username)->first();
            
            $checkPass = check($password,$userInfo['password']);

            if(!$checkPass){

                session()->setFlashData('fail','Incorrect credentials !');
                return redirect()->to("/signin/student")->withInput();

            }
            else{
                $user = $userInfo['username'];
                session()->set('user',$user);
                return redirect()->to("/StudentDashboard/index");

            }

            
        }

    }
    
    public function teacher(){

        $validation = $this->validate([
            
            'username' => ['rules' => 'required|min_length[3]|max_length[20]|is_not_unique[teachers.username]', 
                            'errors' =>['required'=> '',
                                        'min_length' => 'Min 3 Characters',
                                        'max_length' => 'Max 20 Characters',
                                        'is_not_unique' => 'Username not found'
                                        ]
                        ],
            'password' => ['rules' => 'required|min_length[6]|max_length[50]', 
                'errors' =>['required'=> '',
                            'min_length' => 'Min 6 Characters',
                            'max_length' => 'Max 50 Characters'
                            ]
            ]
        ]);

        if (! $validation){
            echo view('login/header', ['validation' => $this->validator]);
            echo view('login/t_login');
            echo view('login/footer');
        }
        else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $teacherModel = new \App\Models\TeacherModel();
            $userInfo = $userModel->where('username',$username)->first();
            
            $checkPass = check($password,$userInfo['password']);

            if(!$checkPass){

                session()->setFlashData('fail','Incorrect credentials !');
                return redirect()->to("/signin/student")->withInput();

            }
            else{
                $user = $userInfo['username'];
                session()->set('tuser',$user);
                return redirect()->to("/TeacherDashboard/index");

            }

            
        }
    }

    public function student_register(){

        echo view('login/header');
        echo view('login/st_register');
        echo view('login/footer');

    }

    public function st_register(){

        // $validation = $this->validate([
        //         'username' => 'required|min_length[3]|max_length[20]|is_unique[users.username]',
        //         'email' => 'required|valid_email|is_unique[users.email]',
        //         'phone' => 'required|regex_match[/^[0-9]{10}$/]',
        //         'name' => 'required|min_length[3]|max_length[20]',
        //         'password' => 'required|min_length[6]|max_length[50]',
        //         'cpassword' => 'required|matches[password]'
        // ]);

        $validation = $this->validate([
            'email' => ['rules' => 'required|valid_email|is_unique[users.email]', 
                                'errors' =>['required'=> '*Required',
                                            'valid_email' => 'Enter valid email',
                                            'is_unique' => 'Email already exixts'
                                            ]
                            ],
            'username' => ['rules' => 'required|min_length[3]|max_length[20]|is_unique[users.username]', 
                            'errors' =>['required'=> '*Required',
                                        'min_length' => 'Min 3 Characters',
                                        'max_length' => 'Max 20 Characters',
                                        'is_unique' => 'Username already taken'
                                        ]
                        ],
            'phone' => ['rules' => 'required|regex_match[/^[0-9]{10}$/]', 
                        'errors' =>['required'=> '*Required',
                                    'regex_match' => 'Enter valid phone number'
                                    ]
                    ],

            'name' => ['rules' => 'required|min_length[3]|max_length[20]', 
                    'errors' =>['required'=> '*Required',
                                'min_length' => 'Min 3 Characters',
                                'max_length' => 'Max 20 Characters'
                                ]
                ],
            
            'password' => ['rules' => 'required|min_length[6]|max_length[50]', 
                'errors' =>['required'=> '*Required',
                            'min_length' => 'Min 6 Characters',
                            'max_length' => 'Max 50 Characters'
                            ]
            ],

            'cpassword' => ['rules' => 'required|matches[password]', 
                'errors' =>['required'=> '*Required',
                            'matches' => 'Password didn\'t match'
                            ]
            ]
        ]);

        if(! $validation){
            
            echo view('login/header',['validation'=>$this->validator]);
            echo view('login/st_register');
            echo view('login/footer');
        }
        else {

            $name = $this->request->getPost('name');
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');

            $values = [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'verified' => 'false'
            ];

            $userModel = new \App\Models\UserModel();
            $query = $userModel->insert($values);

            if ($query){
                echo view('login/header');
                echo "<script>alert('Account Created !'); </script> ";
                echo view('login/st_login');
                echo view('login/footer');
            }
            else{
                echo "Opps Something went wrong !!!";
            }

           
        }


    }

    public function t_register(){

        // $validation = $this->validate([
        //         'username' => 'required|min_length[3]|max_length[20]|is_unique[teachers.username]',
        //         'email' => 'required|valid_email|is_unique[teachers.email]',
        //         'phone' => 'required|regex_match[/^[0-9]{10}$/]',
        //         'name' => 'required|min_length[3]|max_length[20]',
        //         'password' => 'required|min_length[6]|max_length[50]',
        //         'cpassword' => 'required|matches[password]'
        // ]);

        $validation = $this->validate([
            'email' => ['rules' => 'required|valid_email|is_unique[teachers.email]', 
                                'errors' =>['required'=> '*Required',
                                            'valid_email' => 'Enter valid email',
                                            'is_unique' => 'Email already exixts'
                                            ]
                            ],
            'username' => ['rules' => 'required|min_length[3]|max_length[20]|is_unique[teachers.username]', 
                            'errors' =>['required'=> '*Required',
                                        'min_length' => 'Min 3 Characters',
                                        'max_length' => 'Max 20 Characters',
                                        'is_unique' => 'Username already taken'
                                        ]
                        ],
            'phone' => ['rules' => 'required|regex_match[/^[0-9]{10}$/]', 
                        'errors' =>['required'=> '*Required',
                                    'regex_match' => 'Enter valid phone number'
                                    ]
                    ],

            'name' => ['rules' => 'required|min_length[3]|max_length[20]', 
                    'errors' =>['required'=> '*Required',
                                'min_length' => 'Min 3 Characters',
                                'max_length' => 'Max 20 Characters'
                                ]
                ],
            
            'password' => ['rules' => 'required|min_length[6]|max_length[50]', 
                'errors' =>['required'=> '*Required',
                            'min_length' => 'Min 6 Characters',
                            'max_length' => 'Max 50 Characters'
                            ]
            ],

            'cpassword' => ['rules' => 'required|matches[password]', 
                'errors' =>['required'=> '*Required',
                            'matches' => 'Password didn\'t match'
                            ]
            ]
        ]);

        if(! $validation){
            
            echo view('login/header',['validation'=>$this->validator]);
            echo view('login/t_register');
            echo view('login/footer');
        }
        else {

            $name = $this->request->getPost('name');
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('phone');
            $password = $this->request->getPost('password');

            $values = [
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'verified' => 'false',
                'approve' => 'false'
            ];

            $teacherModel = new \App\Models\TeacherModel();
            $query = $teacherModel->insert($values);

            echo view('login/header');
            echo "<script>alert('Account Created !'); </script> ";
            echo view('login/t_login');
            echo view('login/footer');
        }


    }

}
