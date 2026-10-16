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





}