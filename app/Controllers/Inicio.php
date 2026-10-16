<?php
namespace App\Controllers;

use App\Models\TareaModel;

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

        $model = new \App\Models\UsuarioModel();
        $usuario = $model->where('correo', $correo)->first();

        if ($usuario && password_verify($clave, $usuario['contrasena'])) {
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'ingresado' => true
            ]);
            return redirect()->to(base_url('tareas'));
        }

        // Tu cuenta directa sin necesidad de estar en la tabla
        if ($correo === 'areyesc30@miumg.edu.gt' && $clave === '123456') {
            session()->set([
                'id' => 1,
                'nombre' => 'Alex Fernando Reyes',
                'correo' => 'areyesc30@miumg.edu.gt',
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

        $model = new TareaModel();
        $datos = [
            'nombre' => session()->get('nombre'),
            'tareas' => $model->where('usuario_id', 1)->findAll()
        ];

        return view('lista_tareas', $datos);
    }

    public function guardar()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('/'));
        }

        $model = new TareaModel();
        $model->insert([
            'usuario_id' => 1,
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        return redirect()->to(base_url('tareas'));
    }

    public function completar($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('/'));
        }

        $model = new TareaModel();
        $model->update($id, ['estado' => 'completada']);

        return redirect()->to(base_url('tareas'));
    }

    public function eliminar($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('/'));
        }

        $model = new TareaModel();
        $model->delete($id);

        return redirect()->to(base_url('tareas'));
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    public function recuperar_clave()
    {
        helper(['form', 'url']);
        return view('recuperar_clave');
    }

    public function enviar_recuperacion()
    {
        $correo = $this->request->getPost('correo');
        
        $usuario_valido = [
            'correo' => 'areyesc30@miumg.edu.gt',
            'contrasena' => '123456',
            'nombre' => 'Alex Fernando Reyes'
        ];

        if ($correo === $usuario_valido['correo']) {
            session()->setFlashdata('exito', 
                "Hola " . $usuario_valido['nombre'] . ", tus datos de acceso son: <br>" .
                "Correo: " . $usuario_valido['correo'] . "<br>" .
                "Contraseña: " . $usuario_valido['contrasena']
            );
        } else {
            session()->setFlashdata('error', 'No encontramos ninguna cuenta con ese correo.');
        }

        return redirect()->back();
    }


    public function registro()
    {
        helper(['form', 'url']);
        return view('registro');
    }

    public function guardar_registro()
    {
        $nombre = $this->request->getPost('nombre');
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('contrasena');

        $model = new \App\Models\UsuarioModel();

        if ($model->where('correo', $correo)->first()) {
            session()->setFlashdata('error', 'Este correo ya está registrado.');
            return redirect()->back();
        }

        $model->insert([
            'nombre' => $nombre,
            'correo' => $correo,
            'contrasena' => password_hash($clave, PASSWORD_DEFAULT),
            'rol' => 'usuario'
        ]);

        session()->setFlashdata('exito', '¡Cuenta creada! Ya puedes iniciar sesión.');
        return redirect()->to(base_url('/'));
    }


}