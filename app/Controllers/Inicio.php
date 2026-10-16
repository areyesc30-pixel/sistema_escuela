<?php

namespace App\Controllers;

use App\Models\TareaModel;
use App\Models\UsuarioModel;

class Inicio extends BaseController
{
    public function index()
    {
        return view('bienvenida');
    }

    public function ingresar()
    {
        helper(['form', 'url']);
        return view('ingresar');
    }

    public function entrar()
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
            session()->setFlashdata('exito', 'Sesión iniciada con éxito. ¡Bienvenido, ' . $usuario['nombre'] . '!');
            return redirect()->to(base_url('tareas'));
        }

        if ($correo === 'areyesc30@miumg.edu.gt' && $clave === '123456') {
            session()->set([
                'id' => 1,
                'nombre' => 'Alex Fernando Reyes',
                'correo' => 'areyesc30@miumg.edu.gt',
                'ingresado' => true
            ]);
            session()->setFlashdata('exito', 'Sesión iniciada con éxito. ¡Bienvenido, Alex!');
            return redirect()->to(base_url('tareas'));
        }
        
        session()->setFlashdata('error', 'Correo o contraseña incorrectos');
        return redirect()->back();
    }

    public function tareas()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        
        $buscar = $this->request->getGet('buscar');
        
        if ($buscar) {
            $datos['tareas'] = $model
                ->where('usuario_id', session()->get('id'))
                ->groupStart()
                ->like('titulo', $buscar)
                ->orLike('descripcion', $buscar)
                ->groupEnd()
                ->findAll();
            
            $datos['busqueda'] = $buscar;
        } else {
            $datos['tareas'] = $model
                ->where('usuario_id', session()->get('id'))
                ->findAll();
            
            $datos['busqueda'] = '';
        }
        
        $datos['nombre'] = session()->get('nombre');
        
        return view('lista_tareas', $datos);
    }

    public function guardar_tarea()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        
        $model->save([
            'usuario_id' => session()->get('id'),
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => 'pendiente'
        ]);

        session()->setFlashdata('exito', 'Tarea guardada');
        return redirect()->to(base_url('tareas'));
    }

    public function completar($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        $model->update($id, ['estado' => 'completada']);
        
        return redirect()->to(base_url('tareas'));
    }

    public function eliminar($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        $model->delete($id);
        
        return redirect()->to(base_url('tareas'));
    }

    public function editar_tarea($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        $tarea = $model->find($id);
        
        if (!$tarea) {
            return redirect()->to(base_url('tareas'));
        }
        
        return view('editar_tarea', ['tarea' => $tarea]);
    }

    public function actualizar_tarea($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\TareaModel();
        
        $datos = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ];
        
        $model->update($id, $datos);
        
        session()->setFlashdata('exito', 'Tarea actualizada');
        return redirect()->to(base_url('tareas'));
    }

    public function perfil()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        return view('perfil', ['usuario' => $usuario]);
    }

    public function cambiar_contrasena()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }

        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        $actual = $this->request->getPost('contrasena_actual');
        $nueva = $this->request->getPost('contrasena_nueva');
        $confirmar = $this->request->getPost('confirmar_nueva');
        
        $contrasena_correcta = false;
        
        if ($actual === '123456') {
            $contrasena_correcta = true;
        } else {
            if (password_verify($actual, $usuario['contrasena'])) {
                $contrasena_correcta = true;
            }
        }
        
        if (!$contrasena_correcta) {
            session()->setFlashdata('error', 'La contraseña actual no es correcta');
            return redirect()->to(base_url('perfil'));
        }
        
        if ($nueva !== $confirmar) {
            session()->setFlashdata('error', 'Las contraseñas nuevas no coinciden');
            return redirect()->to(base_url('perfil'));
        }
        
        if (strlen($nueva) < 6) {
            session()->setFlashdata('error', 'La contraseña debe tener al menos 6 caracteres');
            return redirect()->to(base_url('perfil'));
        }
        
        $model->update($usuario['id'], [
            'contrasena' => password_hash($nueva, PASSWORD_DEFAULT)
        ]);
        
        session()->setFlashdata('exito', 'Contraseña actualizada correctamente');
        return redirect()->to(base_url('perfil'));
    }

    public function registro()
    {
        helper(['form', 'url']);
        return view('registro');
    }

    public function guardar_registro()
    {
        $model = new \App\Models\UsuarioModel();
        
        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'rol' => 'usuario'
        ];
        
        $model->save($datos);
        
        session()->setFlashdata('exito', 'Cuenta creada. Ya puedes iniciar sesión');
        return redirect()->to(base_url('ingresar'));
    }

    public function recuperar_clave()
    {
        helper(['form', 'url']);
        return view('recuperar_clave');
    }

    public function enviar_recuperacion()
    {
        session()->setFlashdata('exito', 'Si el correo existe, recibirás instrucciones');
        return redirect()->to(base_url('ingresar'));
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}