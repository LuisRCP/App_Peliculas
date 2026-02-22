<?php
namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use App\Models\PersonaModel;

class AuthController extends BaseController
{
    public function register()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Datos inválidos'
            ])->setStatusCode(400);
        }

        $personaModel = new PersonaModel();
        $usuarioModel = new UsuarioModel();

        // Crear persona
        $personaId = $personaModel->insert([
            'nombre' => $data['nombre'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno']
        ]);

        // Crear usuario cliente (rol_Id = 2)
        $usuarioModel->insert([
            'email' => $data['email'],
            'clave' => password_hash($data['password'], PASSWORD_DEFAULT),
            'rol_Id' => 2,
            'persona_Id' => $personaId,
            'esta_Activo' => 1
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Cliente registrado correctamente'
        ]);
    }
}