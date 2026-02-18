<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $clave = $this->request->getPost('clave');

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->obtenerPorEmail($email);

        if (!$usuario) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        if (!password_verify($clave, $usuario['clave'])) {
            return redirect()->back()->with('error', 'Contraseña incorrecta');
        }

        session()->set([
            'usuario_id' => $usuario['usuario_Id'],
            'rol_id'     => $usuario['rol_Id'],
            'logged_in'  => true
        ]);

        return redirect()->to('/admin/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}