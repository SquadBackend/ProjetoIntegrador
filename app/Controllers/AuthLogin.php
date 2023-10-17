<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthLogin extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('usuario');
        $senha = $this->request->getVar('senha');
        $usuario = $userModel->where('Email', $email)->first();

        if(is_null($usuario)){
            #return redirect()->back()->withInput()->with('erro', 'Dados invalidos.');
            return redirect()->to(base_url());
        }

        $authVerify = password_verify($senha, $usuario['Senha']);

        if(!$authVerify){
            #return redirect()->back()->withInput()->with('erro', 'Dados invalidos.');
            return redirect()->to(base_url());
        }

        $ses_data = [
            'id' => $usuario['id'],
            'nome' => $usuario['Nome'],
            'tipo' => $usuario['Tipo_usuario'],
            'email' => $usuario['Email'],
            'isLoggedIn' => TRUE
        ];

        $session->set($ses_data);

        if($usuario['Tipo_usuario'] == 0){
            return redirect()->to(base_url() . 'aluno/inicio/');
        }
        return redirect()->to(base_url() . 'cantina/inicio');

    }

    public function logout() {
        session_destroy();
        return redirect()->to(base_url());
    }
}
