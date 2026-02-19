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
    
    public function login()
    {
        $data = $this->request->getJSON(true);
    
        if (!$data) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Datos inválidos'
            ])->setStatusCode(400);
        }
    
        if (empty($data['email']) || empty($data['password'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Email y contraseña requeridos'
            ])->setStatusCode(400);
        }
    
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->obtenerPorEmail($data['email']);
    
        if (!$usuario) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Credenciales incorrectas'
            ])->setStatusCode(401);
        }
    
        if (!$usuario['esta_Activo']) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Usuario inactivo'
            ])->setStatusCode(403);
        }
    
        if (!password_verify($data['password'], $usuario['clave'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Credenciales incorrectas'
            ])->setStatusCode(401);
        }
    
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Login correcto',
            'data' => [
                'usuario_id' => $usuario['usuario_Id'],
                'email' => $usuario['email'],
                'rol_id' => $usuario['rol_Id']
            ]
        ]);
    }
}