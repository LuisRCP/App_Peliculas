<?php

namespace App\Controllers;

use App\Models\PeliculaModel;
use App\Models\GeneroModel;

class PeliculaController extends BaseController
{
    protected $peliculaModel;
    protected $generoModel;

    public function __construct()
    {
        $this->peliculaModel = new PeliculaModel();
        $this->generoModel   = new GeneroModel();
    }

    // LISTAR
    public function index()
    {
        $data['peliculas'] = $this->peliculaModel->obtenerConGenero();
        $data['generos']   = $this->generoModel->findAll();

        return view('admin/peliculas/index', $data);
    }

    // FORM CREAR
    public function create()
    {
        $data['generos'] = $this->generoModel->findAll();
        return view('admin/peliculas/create', $data);
    }

    // GUARDAR
    public function store()
    {
        $file = $this->request->getFile('imagen');
        $nombreImagen = null;

        if ($file && $file->isValid()) {
            $nombreImagen = $file->getRandomName();
            $file->move('public/uploads/peliculas', $nombreImagen);
        }

        $this->peliculaModel->save([
            'nombre'       => $this->request->getPost('nombre'),
            'genero_Id'    => $this->request->getPost('genero_Id'),
            'imagen_url'   => $nombreImagen ? 'uploads/peliculas/' . $nombreImagen : null,
            'descripcion'  => $this->request->getPost('descripcion'),
            'trailer_url'  => $this->request->getPost('trailer_url'),
            'esta_Activo'  => 1
        ]);

        return redirect()->to('/admin/peliculas');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $data['pelicula'] = $this->peliculaModel->find($id);
        $data['generos']  = $this->generoModel->findAll();

        return view('admin/peliculas/edit', $data);
    }

    // ACTUALIZAR
    public function update($id)
    {
        $pelicula = $this->peliculaModel->find($id);
        $file = $this->request->getFile('imagen');

        $nombreImagen = $pelicula['imagen_url'];

        if ($file && $file->isValid()) {
            $nuevoNombre = $file->getRandomName();
            $file->move('public/uploads/peliculas', $nuevoNombre);
            $nombreImagen = 'uploads/peliculas/' . $nuevoNombre;
        }

        $this->peliculaModel->update($id, [
            'nombre'       => $this->request->getPost('nombre'),
            'genero_Id'    => $this->request->getPost('genero_Id'),
            'imagen_url'   => $nombreImagen,
            'descripcion'  => $this->request->getPost('descripcion'),
            'trailer_url'  => $this->request->getPost('trailer_url'),
        ]);

        return redirect()->to('/admin/peliculas');
    }

    // ELIMINAR
    public function delete($id)
    {
        $this->peliculaModel->delete($id);
        return redirect()->to('/admin/peliculas');
    }
}