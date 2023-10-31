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
                    'required' => 'O campo nome não pode estar vazio.',
                ],
            ],
            'cpf' => [
                'rules' => 'required|max_length[11]|is_unique[Usuario.CPF]',
                'errors' => [
                    'required' => 'O campo cpf não pode estar vazio.',
                    'max_length' => 'O CPF têm 11 caracteres.',
                    'is_unique' => 'Já existe uma conta associada a este CPF.',
                ],
            ],
            'matricula' => [
                'rules' => 'required|max_length[12]|is_unique[Usuario.Matricula]',
                'errors' => [
                    'required' => 'O campo matricula não pode estar vazio.',
                    'max_length' => 'A matrícula têm 12 caracteres.',
                    'is_unique' => 'Já existe uma conta associada a esta matrícula.',
                ],
            ],
            'email' => [
                'rules' => 'required|max_length[254]|valid_email',
                'errors' => [
                    'required' => 'O campo e-mail não pode estar vazio.',
                    'max_length' => 'O e-mail deve conter no máximo 254 caracteres.',
                    'valid_email' => 'O endereço de e-mail fornecido não é válido.',
                ],
            ],
            'senha' => [
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => 'O campo senha não pode estar vazio.',
                    'max_length' => 'A senha deve ter no máximo 255 caracteres.',
                ],
            ],
            'senhaconf' => [
                'rules' => 'required|max_length[255]|matches[senha]',
                'errors' => [
                    'required' => 'É necessário confirmar a sua senha.',
                    'matches' => 'As senhas fornecidas não coincidem.',
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
