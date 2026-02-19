<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\PeliculaModel;

class PeliculaController extends BaseController
{
    protected $peliculaModel;

    public function __construct()
    {
        $this->peliculaModel = new PeliculaModel();
    }

    public function index()
    {
        $peliculas = $this->peliculaModel
            ->where('pelicula.esta_Activo', 1)
            ->obtenerConGenero();

        // Convertir imagen_url en URL completa
        foreach ($peliculas as &$p) {
            if ($p['imagen_url']) {
                $p['imagen_url'] = base_url('public/' . $p['imagen_url']);
            }
        }

        return $this->response->setJSON($peliculas);
    }

    //Obtener una película por su ID
    public function show($id)
    {
        $pelicula = $this->peliculaModel
            ->where('pelicula.esta_Activo', 1)
            ->obtenerPorId($id);

        if (!$pelicula) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => 404,
                    'message' => 'Película no encontrada'
                ]);
        }

        if ($pelicula['imagen_url']) {
            $pelicula['imagen_url'] = base_url('public/' . $pelicula['imagen_url']);
        }

        return $this->response->setJSON($pelicula);
    }

}