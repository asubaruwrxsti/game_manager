<?php

namespace App\Controllers;

class LoginController extends BaseController
{
    public function login()
    {
        return view('login/login.php');
    }

    public function login_action()
    {
        $model = model(UserModel::class);
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $data = $model->checkLogin($username, $password);
        
        if ($data) {
            $session = \Config\Services::session();
            $session->set('user_id', $data->id);
            $session->set('user_name', $data->username);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}