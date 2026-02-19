<?php
namespace App\Models;

use CodeIgniter\Model;

class PersonaModel extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'persona_Id';

    protected $allowedFields = [
        'nombre',
        'apellido_paterno',
        'apellido_materno'
    ];

    protected $returnType = 'array';
}