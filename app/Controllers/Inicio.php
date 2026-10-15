<?php
namespace App\Controllers;

class Inicio extends BaseController
{
    public function index()
    {
        helper(['form', 'url']);
        return view('login');
    }

    public function ingresar()
    {
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('contrasena');

        $usuario_valido = [
            'correo' => 'areyesc30@miumg.edu.gt',
            'contrasena' => '123456',
            'nombre' => 'Alex Fernando Reyes'
        ];

        if ($correo === $usuario_valido['correo'] && $clave === $usuario_valido['contrasena']) {
            session()->set([
                'id' => 1,
                'nombre' => $usuario_valido['nombre'],
                'correo' => $usuario_valido['correo'],
                'ingresado' => true
            ]);
            return redirect()->to(base_url('tareas'));
        }
        
        session()->setFlashdata('error', 'Correo o contraseña incorrectos');
        return redirect()->back();
    }

    public function tareas()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('/'));
        }
        
        echo "<h1>Bienvenido, " . session()->get('nombre') . "</h1>";
        echo "<p>Correo: " . session()->get('correo') . "</p>";
        echo "<p>¡Estás dentro de tu sistema de tareas!</p>";
        echo "<a href='" . base_url('salir') . "'>Cerrar sesión</a>";
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}