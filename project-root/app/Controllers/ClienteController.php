<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PersonaModel;

class ClienteController extends BaseController
{
    protected $usuarioModel;
    protected $personaModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
        $this->personaModel = new PersonaModel();
    }

    public function index()
    {
        $data['clientes'] = $this->usuarioModel->obtenerClientes();
        return view('admin/clientes/index', $data);
    }

    private function generarClave($longitud = 6)
    {
        $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $clave = '';
        for ($i = 0; $i < $longitud; $i++) {
            $clave .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }
        return $clave;
    }

    public function store()
    {
        $claveGenerada = $this->generarClave(6);

        $personaId = $this->personaModel->insert([
            'nombre' => $this->request->getPost('nombre'),
            'apellido_paterno' => $this->request->getPost('apellido_paterno'),
            'apellido_materno' => $this->request->getPost('apellido_materno'),
        ]);

        $this->usuarioModel->insert([
            'email' => $this->request->getPost('email'),
            'clave' => password_hash($claveGenerada, PASSWORD_DEFAULT),
            'rol_Id' => 2,
            'persona_Id' => $personaId,
            'esta_Activo' => 1
        ]);

        session()->setFlashdata('claveGenerada', $claveGenerada);

        return redirect()->to('/admin/clientes');
    }

    public function update($id)
    {
        $usuario = $this->usuarioModel->find($id);

        $this->personaModel->update($usuario['persona_Id'], [
            'nombre' => $this->request->getPost('nombre'),
            'apellido_paterno' => $this->request->getPost('apellido_paterno'),
            'apellido_materno' => $this->request->getPost('apellido_materno'),
        ]);

        $this->usuarioModel->update($id, [
            'email' => $this->request->getPost('email'),
        ]);

        return redirect()->to('/admin/clientes');
    }

    public function toggle($id)
    {
        $usuario = $this->usuarioModel->find($id);

        $this->usuarioModel->update($id, [
            'esta_Activo' => $usuario['esta_Activo'] ? 0 : 1
        ]);

        return redirect()->to('/admin/clientes');
    }

    public function resetPassword($id){
        $claveNueva = $this->generarClave(6);

        $this->usuarioModel->update($id, [
            'clave' => password_hash($claveNueva, PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('claveGenerada', $claveNueva);

        return redirect()->to('/admin/clientes');
    }


}
