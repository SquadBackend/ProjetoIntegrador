<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthCadastro extends BaseController
{
    public function index()
    {
        return view('auth/cadastro');
    }

    public function cadastro()
    {
        $userModel = new UserModel();
        $data = [
            'Tipo_usuario' => 0,
            'Tem_auxilio' => 0,
            'Nome' => $this->request->getVar('nome'),
            'Matricula' => $this->request->getVar('matricula'),
            'CPF' => $this->request->getVar('cpf'),
            'Email' => $this->request->getVar('email'),
            'Senha' => password_hash($this->request->getVar('senha'), PASSWORD_DEFAULT)
        ];
        $userModel->save($data);
        return redirect()->to(base_url());
    }
}
