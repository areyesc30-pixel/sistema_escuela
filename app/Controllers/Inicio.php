<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Inicio extends BaseController
{
    public function index()
    {
        $sesion = session()->get('usuario_id');
        if ($sesion) {
            return redirect()->to('panel');
        }
        return view('login');
    }

    public function verificar()
    {
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        $modelo = new UsuarioModel();
        $usuario = $modelo->buscarPorCorreo($correo);

        if (!$usuario) {
            return view('login', ['error' => 'El correo no está registrado']);
        }

        if ($clave !== $usuario['clave']) {
            return view('login', ['error' => 'Contraseña incorrecta']);
        }

        session()->set([
            'usuario_id' => $usuario['id'],
            'nombre' => $usuario['nombre']
        ]);

        return redirect()->to('panel');
    }
}