<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ReservaModel;
use App\Models\CardapioModel;


class CantinaController extends BaseController
{
    public function index()
    {
        return view('cantina/inicio');
    }

    public function cardapio()
    {
        $cardapioModel = new CardapioModel();

        $data['comidas'] = $cardapioModel->findAll();

        return view('cantina/menu', $data);
    }

    public function cadastros()
    {
        $userModel = new UserModel();
        $data['usuarios'] = $userModel->where('Tipo_usuario', 0)->findAll();

        return view('cantina/cadastros', $data);
    }

    public function reservas()
    {
        /*$reservasModel = new ReservaModel();
        $reservas = $reservasModel->findAll();
        $data['reservas'] = $reservas;
        $data['total'] = count($reservas);*/

        $db = \Config\Database::connect();
        $builder = $db->table('Reserva');
        $builder->select('*');
        $builder->join('Usuario', 'Usuario.id = Reserva.Usuario_id');
        $query = $builder->get();

        $reservas = $query->getResult();
        $data['reservas'] = $reservas;
        $data['total'] = count($reservas);

        return view('cantina/reservas', $data);
    }

    public function pagamentos()
    {
        return view('cantina/pagamentos');
    }
}
