<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PedidoModel;
use App\Models\CardapioModel;

class AlunoController extends BaseController
{
    public function index()
    {
        return view('aluno/inicio');
    }

    public function reserva()
    {
        return view('aluno/reservar');
    }

    public function reservar()
    {
        $pedidoModel = new PedidoModel();
        $data = [
            'Usuario_id' => $this->request->getVar('userId'),
            'Data' => date('Y-m-d', strtotime($this->request->getVar('date'))),
            'Turno' => $this->request->getVar('turno')
        ];

        $response = $pedidoModel->insert($data, false);

        if(!$response){
            session()->setFlashdata('erro', 'Ocorreu um erro ao efetuar a reserva ( ' . $data['Data'] .  ' )');
            return redirect()->to(site_url('aluno/reservar','http'));
        }

        session()->setFlashdata('sucesso', 'Reserva ( ' . $data['Data'] . ' ) efetuada com sucesso');
        return redirect()->to(site_url('aluno/reservar','http'));
    }

    public function cardapio()
    {
        $cardapioModel = new CardapioModel();

        $data['comidas'] = $cardapioModel->findAll();

        return view('aluno/cardapio', $data);
    }

    public function historico()
    {
        $pedidoModel = new PedidoModel();

        $data['reservas'] = $pedidoModel->where('Usuario_id', session()->get('id'))->where('Pago', 1)->findAll();

        return view('aluno/historico', $data);
    }

    public function pagamento()
    {
        $pedidoModel = new PedidoModel();

        $data['pedidos'] = $pedidoModel->where('Usuario_id', session()->get('id'))->where('Pago', 0)->findAll();
        $columnPreco = $pedidoModel->where('Usuario_id', session()->get('id'))->where('Pago', 0)->findColumn('Preco');
        if($columnPreco){
                $data['total'] = number_format(array_sum($columnPreco), 2);
        }else{
            $data['total'] = 0;
        }

        return view('aluno/pagamento', $data);
    }
}
