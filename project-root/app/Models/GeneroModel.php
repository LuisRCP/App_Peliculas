<?php

namespace App\Models;

use CodeIgniter\Model;

class GeneroModel extends Model
{
    protected $table = 'genero';
    protected $primaryKey = 'genero_Id';
    protected $allowedFields = ['nombre', 'esta_Activo'];
    protected $returnType = 'array';
}