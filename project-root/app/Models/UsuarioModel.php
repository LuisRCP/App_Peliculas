<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'usuario_Id';

    protected $allowedFields = [
        'email',
        'clave',
        'rol_Id',
        'persona_Id',
        'esta_Activo'
    ];

    protected $returnType = 'array';

    protected $useTimestamps = false;

    public function obtenerPorEmail($email)
    {
        return $this->where('email', $email)
                    ->where('esta_Activo', 1)
                    ->first();
    }
}