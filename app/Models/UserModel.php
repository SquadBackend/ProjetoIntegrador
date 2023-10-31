<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'Usuario';

    protected $allowedFields = [
        'id',
        'Tipo_usuario',
        'Tem_auxilio',
        'Nome',
        'CPF',
        'Email',
        'Senha',
        'Matricula',
        'Bloqueado',
        'Verificado'
    ];

}
