<?php

namespace App\Models;

use CodeIgniter\Model;

class PeliculaModel extends Model
{
    protected $table = 'pelicula';
    protected $primaryKey = 'pelicula_Id';

    protected $allowedFields = [
        'nombre',
        'genero_Id',
        'imagen_url',
        'descripcion',
        'trailer_url',
        'esta_Activo'
    ];

    protected $returnType = 'array';

    public function obtenerConGenero()
    {
        return $this->select('pelicula.*, genero.nombre as genero')
                    ->join('genero', 'genero.genero_Id = pelicula.genero_Id')
                    ->findAll();
    }

    public function obtenerPorId($id)
    {
        return $this->select('pelicula.*, genero.nombre as genero')
                    ->join('genero', 'genero.genero_Id = pelicula.genero_Id')
                    ->where('pelicula.pelicula_Id', $id)
                    ->first();
    }
}