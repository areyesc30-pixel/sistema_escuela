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

        $model = new UsuarioModel();
        $usuario = $model->where('correo', $correo)->first();

        if ($usuario && password_verify($clave, $usuario['contrasena'])) {
            if (!$usuario['activo']) {
                session()->setFlashdata('error', $lang === 'en' ? 'Account is inactive' : 'La cuenta está inactiva');
                return redirect()->back();
            }
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

        session()->setFlashdata('error', $lang === 'en' ? 'Incorrect email or password' : 'Correo o contraseña incorrectos');
        return redirect()->back();
    }

    public function tareas()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $model = new TareaModel();
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
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $lang = session()->get('idioma') ?? 'es';
        $model = new TareaModel();
        $model->save([
            'usuario_id' => session()->get('id'),
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $lang === 'en' ? 'Pending' : 'Pendiente'
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Task saved successfully' : 'Tarea guardada con éxito');
        return redirect()->to(base_url('tareas'));
    }

    public function completar($id)
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $lang = session()->get('idioma') ?? 'es';
        $model = new TareaModel();
        $model->update($id, ['estado' => $lang === 'en' ? 'Completed' : 'Completada']);
        return redirect()->to(base_url('tareas'));
    }

    public function eliminar($id)
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $model = new TareaModel();
        $model->delete($id);
        return redirect()->to(base_url('tareas'));
    }

    public function editar_tarea($id)
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $model = new TareaModel();
        return view('editar_tarea', ['tarea' => $model->find($id)]);
    }

    public function actualizar_tarea($id)
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $lang = session()->get('idioma') ?? 'es';
        $model = new TareaModel();
        $model->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Task updated' : 'Tarea actualizada');
        return redirect()->to(base_url('tareas'));
    }

    public function perfil()
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $model = new UsuarioModel();
        return view('perfil', ['usuario' => $model->find(session()->get('id'))]);
    }

    public function editar_usuario()
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $model = new UsuarioModel();
        return view('editar_usuario', ['usuario' => $model->find(session()->get('id'))]);
    }

    public function actualizar_usuario()
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $lang = session()->get('idioma') ?? 'es';
        $id = session()->get('id');
        $model = new UsuarioModel();
        
        $correoNuevo = $this->request->getPost('correo');
        $existe = $model->where('correo', $correoNuevo)->where('id !=', $id)->first();
        if ($existe) {
            session()->setFlashdata('error', $lang === 'en' ? 'Email already in use' : 'El correo ya está en uso');
            return redirect()->back();
        }

        $model->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $correoNuevo
        ]);
        session()->set([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $correoNuevo
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Information updated' : 'Información actualizada');
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
            
            $model = new UsuarioModel();
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
        $model = new UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        if (!empty($usuario['foto']) && file_exists(FCPATH . 'uploads/' . $usuario['foto'])) {
            unlink(FCPATH . 'uploads/' . $usuario['foto']);
        }
        
        $model->update(session()->get('id'), ['foto' => null]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Photo deleted' : 'Foto eliminada');
        return redirect()->to(base_url('perfil'));
    }

    public function cambiar_contrasena()
    {
        if (!session()->get('ingresado')) return redirect()->to(base_url('ingresar'));
        $lang = session()->get('idioma') ?? 'es';
        $model = new UsuarioModel();
        $usuario = $model->find(session()->get('id'));
        
        $actual = $this->request->getPost('contrasena_actual');
        $nueva = $this->request->getPost('contrasena_nueva');
        $confirmar = $this->request->getPost('confirmar_nueva');
        
        if (!password_verify($actual, $usuario['contrasena'])) {
            session()->setFlashdata('error', $lang === 'en' ? 'Current password incorrect' : 'Contraseña actual incorrecta');
            return redirect()->back();
        }
        if ($nueva !== $confirmar) {
            session()->setFlashdata('error', $lang === 'en' ? 'Passwords do not match' : 'Las contraseñas no coinciden');
            return redirect()->back();
        }
        if (strlen($nueva) < 6) {
            session()->setFlashdata('error', $lang === 'en' ? 'Minimum 6 characters' : 'Mínimo 6 caracteres');
            return redirect()->back();
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
        $model = new UsuarioModel();
        
        $correo = $this->request->getPost('correo');
        $existe = $model->where('correo', $correo)->first();
        if ($existe) {
            session()->setFlashdata('error', $lang === 'en' ? 'Email already registered' : 'El correo ya está registrado');
            return redirect()->back();
        }

        $model->save([
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $correo,
            'contrasena' => password_hash($this->request->getPost('contrasena'), PASSWORD_DEFAULT),
            'rol' => 'usuario',
            'activo' => 1
        ]);
        session()->setFlashdata('exito', $lang === 'en' ? 'Account created successfully. You can now sign in.' : 'Cuenta creada con éxito. Ya puedes iniciar sesión.');
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
        session()->setFlashdata('exito', $lang === 'en' ? 'If the email exists, instructions will be sent' : 'Si el correo existe, recibirás instrucciones');
        return redirect()->to(base_url('ingresar'));
    }

    public function idioma($codigo)
    {
        session()->set('idioma', $codigo === 'en' ? 'en' : 'es');
        return redirect()->back();
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}