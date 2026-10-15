<?php

namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        helper(['url']);
        return view('login');
    }

    public function verificar()
    {
        helper(['url']);
        
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        // Prueba simple primero
        if ($correo === 'areyesc30@miumg.edu.gt' && $clave === 'Admin123') {
            session()->set('nombre', 'Alex Fernando Reyes');
            return view('panel');
        }

        return view('login', ['error' => 'Correo o contraseña incorrectos']);
    }
}