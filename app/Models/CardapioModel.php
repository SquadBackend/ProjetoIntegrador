<?php

namespace App\Models;

use CodeIgniter\Model;

class CardapioModel extends Model
{
    protected $table = 'Cardapio';

    protected $allowedFields = [
        'id',
        'Comida',
        'Texto'
    ];
}
