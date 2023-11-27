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
        #$pedidoModel = new PedidoModel();
        
        #$reservas = $pedidoModel->where('Usuario_id', session()->get('id'))->where('Pago', 1)->findAll();
        $db = \Config\Database::connect();
        $builder = $db->table('Pedido');
        $builder->select('*');
        $builder->where('Pago', 1);
        $builder->where("Usuario_id", session()->get("id"));

        $dataAtual = time();
        $dataUmaSemanaAtrás = $dataAtual - (7 * 24 * 60 * 60);
        //$dataUmaSemanaAtrás = date('Y-m-d 00:00:00', $dataUmaSemanaAtrás);
        $dataUmaSemanaAtrás = date('Y-m-d', $dataUmaSemanaAtrás);
        
        if($this->request->getGet("date")){
            //dataFiltroStart = date('Y-m-d 00:00:00', strtotime($this->request->getGet("date")));
            //$dataFiltroEnd = date('Y-m-d 23:59:59', strtotime($this->request->getGet("date")));
            //$builder->where('Criado_em >=', $dataFiltroStart);
            //$builder->where('Criado_em <=', $dataFiltroEnd);
            $builder->where('Data', $this->request->getGet("date"));
        }else{
            //$builder->where('Criado_em >= ', $dataUmaSemanaAtrás);
            $builder->where('Data >=', $dataUmaSemanaAtrás);
        }

        $query = $builder->get();
        $reservas = $query->getResultArray();
                
        foreach($reservas as $key => $reserva){
            if($reserva['Data'] == date('Y-m-d')){
                $arrayDataHoje = $reservas[$key];
                unset($reservas[$key]);
                array_unshift($reservas, $arrayDataHoje);
                break;
            }
        }
        $data['reservas'] = $reservas;


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
