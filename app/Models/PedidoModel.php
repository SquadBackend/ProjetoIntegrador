<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table = 'Pedido';

    protected $allowedFields = [
        'Usuario_id',
        'Data',
        'Turno',
        'Preco'
    ];

}
