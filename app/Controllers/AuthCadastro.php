<?php

namespace App\Controllers;
use App\Models\UserModel;

class AuthCadastro extends BaseController
{

    public function __construct()
	{
		helper('form');
	}

    public function index()
    {
        return view('auth/cadastro');
    }

    public function cadastro()
    {
        $userModel = new UserModel();
        # faz a validação ...
        $rules =[
            'nome' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'O campo nome não pode está vazio',
                ],
            ],
            'cpf' => [
                'rules' => 'required|max_length[11]|is_unique[Usuario.CPF]',
                'errors' => [
                    'required' => 'O campo cpf não pode está vazio',
                    'max_length' => 'O cpf tem no maximo 11 caracteres',
                    'is_unique' => 'Já tem uma conta usando este CPF',
                ],
            ],
            'matricula' => [
                'rules' => 'required|max_length[12]|is_unique[Usuario.Matricula]',
                'errors' => [
                    'required' => 'O campo matricula não pode está vazio',
                    'max_length' => 'A matricula tem no maximo 12 caracteres',
                    'is_unique' => 'Já tem uma conta usando esta matricula',
                ],
            ],
            'email' => [
                'rules' => 'required|max_length[254]|valid_email',
                'errors' => [
                    'required' => 'O campo email não pode está vazio',
                    'max_length' => 'O E-mail tem no maximo 254 caracteres',
                    'valid_email' => 'Este não é um e-mail válido',
                ],
            ],
            'senha' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'O campo senha não pode está vazio',
                    'max_length' => 'O tamanho máximo da senha é de 255 caracteres',
                ],
            ],
            'senhaconf' => [
                'rules' => 'required|max_length[255]|matches[senha]',
                'errors' => [
                    'required' => 'Você deve confirmar a sua senha',
                    'matches' => 'As senhas não correspondem',
                ],
            ],
        ];

        if($this->validate($rules)){
            # coloca os dados no array data
            $data = [
                'Tipo_usuario' => 0,
                'Tem_auxilio' => 0,
                'Nome' => $this->request->getVar('nome'),
                'Matricula' => $this->request->getVar('matricula'),
                'CPF' => $this->request->getVar('cpf'),
                'Email' => $this->request->getVar('email'),
                'Senha' => password_hash($this->request->getVar('senha'), PASSWORD_DEFAULT)
            ];

            # salva os dados no banco de dados
            if(!$userModel->save($data)) {
                session()->setFlashdata('erro_interno', 'Ocorreu um erro ao salvar os dados no banco de dados');
                return redirect()->to(site_url('cadastro', 'http'));
            }

            session()->setFlashdata('sucesso', 'Cadastro feito com sucesso!');

            #retorna para a tela de login
            return redirect()->to(site_url('', 'http'));
        }else{
            return view('auth/cadastro', [
				'validation' => $this->validator,
                'nome' => $this->request->getVar('nome'),
                'cpf' => $this->request->getVar('cpf'),
                'matricula' => $this->request->getVar('matricula'),
                'email' => $this->request->getVar('email'),
			]);
        }








    }
}
