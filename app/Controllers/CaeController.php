<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PedidoModel;

class CaeController extends BaseController
{
    public function index()
    {
        return view('cae/inicio');
    }

    public function cadastros()
    {
        $userModel = new UserModel();
        $data['usuarios'] = $userModel->where('Tipo_usuario', 0)->findAll();

        return view('cae/cadastros', $data);
    }

    public function reservas()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Pedido');
        $builder->select('*');
        $builder->where('Pago', 1);
        $builder->where('Data', date('Y-m-d'));
        $builder->join('Usuario', 'Usuario.id = Pedido.Usuario_id');
        $query = $builder->get();

        $reservas = $query->getResult();
        $data['reservas'] = $reservas;
        $data['total'] = count($reservas);

        return view('cae/reservas', $data);
    }

    public function historico(){
        $db = \Config\Database::connect();
        $builder = $db->table('Pedido');
        $builder->select('*');
        $builder->where('Pago', 1);
        $builder->join('Usuario', 'Usuario.id = Pedido.Usuario_id');
        $query = $builder->get();

        $reservas = $query->getResult();
        $data['reservas'] = $reservas;
        $data['total'] = count($reservas);

        return view('cae/historico', $data);
    }
}
