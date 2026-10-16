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
        $model = new \App\Models\TareaModel();
        
        $buscar = $this->request->getGet('buscar');
        
        if ($buscar) {
            $datos['tareas'] = $model
                ->where('usuario_id', session()->get('id'))
                ->like('titulo', $buscar)
                ->orLike('descripcion', $buscar)
                ->where('usuario_id', session()->get('id'))
                ->findAll();
            
            $datos['busqueda'] = $buscar;
        } else {
            $datos['tareas'] = $model
                ->where('usuario_id', session()->get('id'))
                ->findAll();
            
            $datos['busqueda'] = '';
        }
        
        // Agregamos tu nombre para que aparezca en la página 👇
        $datos['nombre'] = session()->get('nombre');
        
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





        public function editar_tarea($id)
    {
        helper(['form', 'url']);
        
        $model = new \App\Models\TareaModel();
        $tarea = $model->find($id);
        
        if (!$tarea) {
            return redirect()->to(base_url('tareas'));
        }
        
        return view('editar_tarea', ['tarea' => $tarea]);
    }

    public function actualizar_tarea($id)
    {
        $model = new \App\Models\TareaModel();
        
        $datos = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ];
        
        $model->update($id, $datos);
        
        session()->setFlashdata('exito', 'Tarea actualizada correctamente');
        return redirect()->to(base_url('tareas'));
    }





    public function perfil()
    {
        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        return view('perfil', ['usuario' => $usuario]);
    }

        public function cambiar_contrasena()
    {
        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        $actual = $this->request->getPost('contrasena_actual');
        $nueva = $this->request->getPost('contrasena_nueva');
        $confirmar = $this->request->getPost('confirmar_nueva');
        
        // Permite la contraseña que usamos para entrar
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














}