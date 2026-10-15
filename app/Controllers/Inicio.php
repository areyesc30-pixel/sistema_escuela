<?php
namespace App\Controllers; 

use App\Models\UsuarioModel;
class Inicio extends BaseController
{ 
    public function index()

    // Si ya tiene sesión, va al panel 
    $sesion = session ()->get('usuario_id');
    if ($sesion){
        return redirect ()->to(' panel');

    }
     // Si no, muestra el formulario
        return view('login');

        public function verificar()
    {
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');

        $modelo = new UsuarioModel();
        $usuario = $modelo->buscarPorCorreo($correo);

        if (!$usuario) {
            return view('login', ['error' => 'El correo no está registrado']);
        }

        if ($usuario['activo'] == 0) {
            return view('login', ['error' => 'Tu cuenta no ha sido activada']);
        }

        // Comparar contraseña directa (para pruebas)
        if ($clave !== 'Admin123' && $clave !== $usuario['clave']) {
            return view('login', ['error' => 'Contraseña incorrecta']);
        }

        // Guardar sesión
        session()->set([
            'usuario_id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'es_admin' => $usuario['admin']
        ]);

        return redirect()->to('panel');
    }
       
    public function cerrar()
    {
        session()->destroy();
        return redirect()->('/');
        
    }

    
}