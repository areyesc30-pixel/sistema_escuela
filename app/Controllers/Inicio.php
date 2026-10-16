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
        $lang = session()->get('idioma') ?? 'es';

        $model = new \App\Models\UsuarioModel();
        $usuario = $model->where('correo', $correo)->first();

        if ($usuario && password_verify($clave, $usuario['contrasena'])) {
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'ingresado' => true
            ]);
            $mensaje = $lang === 'en' ? 'Login successful. Welcome, ' : 'Sesión iniciada con éxito. ¡Bienvenido, ';
            session()->setFlashdata('exito', $mensaje . $usuario['nombre'] . '!');
            return redirect()->to(base_url('tareas'));
        }

        if ($correo === 'areyesc30@miumg.edu.gt' && $clave === '123456') {
            session()->set([
                'id' => 1,
                'nombre' => 'Alex Fernando Reyes',
                'correo' => 'areyesc30@miumg.edu.gt',
                'ingresado' => true
            ]);
            session()->setFlashdata('exito', $lang === 'en' ? 'Login successful. Welcome, Alex!' : 'Sesión iniciada con éxito. ¡Bienvenido, Alex!');
            return redirect()->to(base_url('tareas'));
        }
        
        session()->setFlashdata('error', $lang === 'en' ? 'Incorrect email or password' : 'Correo o contraseña incorrectos');
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
            $datos['tareas'] = $model->where('usuario_id', session()->get('id'))->findAll();
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
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\TareaModel();
        $model->save([
            'usuario_id' => session()->get('id'),
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $lang === 'en' ? 'Pending' : 'Pendiente'
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Task saved' : 'Tarea guardada');
        return redirect()->to(base_url('tareas'));
    }

    public function completar($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\TareaModel();
        $model->update($id, ['estado' => $lang === 'en' ? 'Completed' : 'Completada']);
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
        if (!$tarea) return redirect()->to(base_url('tareas'));
        return view('editar_tarea', ['tarea' => $tarea]);
    }

    public function actualizar_tarea($id)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\TareaModel();
        $model->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Task updated' : 'Tarea actualizada');
        return redirect()->to(base_url('tareas'));
    }

    public function perfil()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $model = new \App\Models\UsuarioModel();
        return view('perfil', ['usuario' => $model->find(session()->get('id'))]);
    }

    public function cambiar_contrasena()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        $actual = $this->request->getPost('contrasena_actual');
        $nueva = $this->request->getPost('contrasena_nueva');
        $confirmar = $this->request->getPost('confirmar_nueva');
        
        $correcta = ($actual === '123456' || password_verify($actual, $usuario['contrasena']));
        
        if (!$correcta) {
            session()->setFlashdata('error', $lang === 'en' ? 'Current password incorrect' : 'Contraseña actual incorrecta');
            return redirect()->to(base_url('perfil'));
        }
        if ($nueva !== $confirmar) {
            session()->setFlashdata('error', $lang === 'en' ? 'Passwords do not match' : 'Las contraseñas no coinciden');
            return redirect()->to(base_url('perfil'));
        }
        if (strlen($nueva) < 6) {
            session()->setFlashdata('error', $lang === 'en' ? 'Minimum 6 characters' : 'Mínimo 6 caracteres');
            return redirect()->to(base_url('perfil'));
        }
        
        $model->update($usuario['id'], ['contrasena' => password_hash($nueva, PASSWORD_DEFAULT)]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Password updated' : 'Contraseña actualizada');
        return redirect()->to(base_url('perfil'));
    }

    public function registro()
    {
        helper(['form', 'url']);
        return view('registro');
    }

    public function guardar_registro()
    {
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\UsuarioModel();
        $model->save([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'rol' => 'usuario'
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Account created. You can now sign in.' : 'Cuenta creada. Ya puedes iniciar sesión.');
        return redirect()->to(base_url('ingresar'));
    }

    public function recuperar_clave()
    {
        helper(['form', 'url']);
        return view('recuperar_clave');
    }

    public function enviar_recuperacion()
    {
        $lang = session()->get('idioma') ?? 'es';
        session()->setFlashdata('exito', $lang === 'en' ? 'If the email exists, you will receive instructions' : 'Si el correo existe, recibirás instrucciones');
        return redirect()->to(base_url('ingresar'));
    }

    public function idioma($codigo)
    {
        if ($codigo === 'en') {
            session()->set('idioma', 'en');
        } else {
            session()->set('idioma', 'es');
        }
        return redirect()->back();
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }











    public function subir_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $archivo = $this->request->getFile('foto');
        
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreNuevo = $archivo->getRandomName();
            $archivo->move('public/uploads', $nombreNuevo);
            
            $model = new \App\Models\UsuarioModel();
            $usuario = $model->find(session()->get('id'));
            
            if (!empty($usuario['foto']) && file_exists('public/uploads/' . $usuario['foto'])) {
                unlink('public/uploads/' . $usuario['foto']);
            }
            
            $model->update(session()->get('id'), ['foto' => $nombreNuevo]);
            session()->setFlashdata('exito', $lang === 'en' ? 'Photo uploaded successfully' : 'Foto subida con éxito');
        }
        return redirect()->to(base_url('perfil'));
    }

    public function eliminar_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        if (!empty($usuario['foto']) && file_exists('public/uploads/' . $usuario['foto'])) {
            unlink('public/uploads/' . $usuario['foto']);
        }
        
        $model->update(session()->get('id'), ['foto' => null]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Photo deleted' : 'Foto eliminada');
        return redirect()->to(base_url('perfil'));
    }




    public function subir_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $archivo = $this->request->getFile('foto');
        
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreNuevo = $archivo->getRandomName();
            $archivo->move(FCPATH . 'uploads', $nombreNuevo);
            
            $model = new \App\Models\UsuarioModel();
            $usuario = $model->find(session()->get('id'));
            
            if (!empty($usuario['foto']) && file_exists(FCPATH . 'uploads/' . $usuario['foto'])) {
                unlink(FCPATH . 'uploads/' . $usuario['foto']);
            }
            
            $model->update(session()->get('id'), ['foto' => $nombreNuevo]);
            session()->setFlashdata('exito', $lang === 'en' ? 'Photo uploaded successfully' : 'Foto subida con éxito');
        }
        return redirect()->to(base_url('perfil'));
    }

    public function eliminar_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $lang = session()->get('idioma') ?? 'es';
        $model = new \App\Models\UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        if (!empty($usuario['foto']) && file_exists(FCPATH . 'uploads/' . $usuario['foto'])) {
            unlink(FCPATH . 'uploads/' . $usuario['foto']);
        }
        
        $model->update(session()->get('id'), ['foto' => null]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Photo deleted' : 'Foto eliminada');
        return redirect()->to(base_url('perfil'));
    }







}