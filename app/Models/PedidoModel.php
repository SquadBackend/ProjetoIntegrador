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
        'Preco',
        'Pago',
        'Criado_em'
    ];


    public function deleteAll($id){
        return $this->where('Usuario_id', $id)->delete();
    }
}
