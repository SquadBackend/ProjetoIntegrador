<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservaModel extends Model
{
    protected $table = 'Reserva';

    protected $allowedFields = [
        'Usuario_id',
        'Data',
        'Turno'
    ];

}
