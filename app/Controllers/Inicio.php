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

    public function cambiar_idioma($codigo = 'es')
    {
        if ($codigo === 'en') {
            session()->set('idioma_actual', 'en');
        } else {
            session()->set('idioma_actual', 'es');
        }
        return redirect()->back();
    }

    public function ingresar()
    {
        helper(['form', 'url']);
        return view('ingresar');
    }

    public function entrar()
    {
        $correo = $this->request->getPost('correo');
        $clave = $this->request->getPost('clave');
        $idioma = session()->get('idioma_actual') ?? 'es';

        $modelo = new UsuarioModel();
        $usuario = $modelo->where('correo', $correo)->first();

        if (!$usuario) {
            $mensaje = $idioma==='en'?'Email not found':'Correo no encontrado';
            return redirect()->back()->with('error', $mensaje);
        }

        $pass = '';
        if (isset($usuario['contrasena'])) {
            $pass = $usuario['contrasena'];
        } elseif (isset($usuario['clave'])) {
            $pass = $usuario['clave'];
        } else {
            $mensaje = $idioma==='en'?'Database error':'Error en base de datos';
            return redirect()->back()->with('error', $mensaje);
        }

        if (password_verify($clave, $pass)) {
            $mensajeBienvenida = $idioma==='en'?'Login successful! Welcome back':'¡Ingreso exitoso! Bienvenido';
            session()->set([
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'ingresado' => true
            ]);
            session()->setFlashdata('exito', $mensajeBienvenida);
            return redirect()->to(base_url('tareas'));
        }

        $mensaje = $idioma==='en'?'Incorrect password':'Contraseña incorrecta';
        return redirect()->back()->with('error', $mensaje);
    }

    public function registro()
    {
        helper(['form', 'url']);
        return view('registro');
    }

    public function registrar()
    {
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new UsuarioModel();
        
        $clave = $this->request->getPost('clave');
        $datos = [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $this->request->getPost('correo'),
            'activo' => 1
        ];
        
        if (in_array('contrasena', $modelo->allowedFields)) {
            $datos['contrasena'] = password_hash($clave, PASSWORD_DEFAULT);
        } elseif (in_array('clave', $modelo->allowedFields)) {
            $datos['clave'] = password_hash($clave, PASSWORD_DEFAULT);
        }

        $modelo->insert($datos);
        $mensaje = $idioma==='en'?'Account created successfully. Please sign in':'Cuenta creada con éxito. Ya puedes ingresar';
        return redirect()->to(base_url('ingresar'))->with('exito', $mensaje);
    }

    public function recuperar_clave()
    {
        helper(['form', 'url']);
        return view('recuperar_clave');
    }

    public function enviar_recuperacion()
    {
        $idioma = session()->get('idioma_actual') ?? 'es';
        $mensaje = $idioma==='en'?'If the email exists, instructions have been sent':'Si el correo existe, recibirás instrucciones';
        return redirect()->to(base_url('ingresar'))->with('exito', $mensaje);
    }

    public function tareas()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $modelo = new TareaModel();
        $idUsuario = session()->get('id');
        $datos['tareas'] = $modelo->where('usuario_id', $idUsuario)->findAll();
        return view('lista_tareas', $datos);
    }

    public function guardar_tarea()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new TareaModel();
        
        $datos = [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion'),
            'usuario_id' => session()->get('id'),
            'estado' => $idioma==='en'?'Pending':'Pendiente'
        ];

        $modelo->insert($datos);
        $mensaje = $idioma==='en'?'Task saved successfully':'Tarea guardada con éxito';
        return redirect()->back()->with('exito', $mensaje);
    }

    public function editar_tarea($id = null)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $modelo = new TareaModel();
        $datos['tarea'] = $modelo->where('id', $id)->where('usuario_id', session()->get('id'))->first();
        if (!$datos['tarea']) {
            return redirect()->to(base_url('tareas'));
        }
        return view('editar_tarea', $datos);
    }

    public function actualizar_tarea($id = null)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new TareaModel();
        
        $modelo->update($id, [
            'titulo' => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);
        
        $mensaje = $idioma==='en'?'Task updated':'Tarea actualizada';
        return redirect()->to(base_url('tareas'))->with('exito', $mensaje);
    }

    public function completar_tarea($id = null)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new TareaModel();
        
        $modelo->update($id, ['estado' => $idioma==='en'?'Completed':'Completada']);
        
        $mensaje = $idioma==='en'?'Task marked as completed':'Tarea marcada como completada';
        return redirect()->back()->with('exito', $mensaje);
    }

    public function eliminar_tarea($id = null)
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new TareaModel();
        
        $modelo->where('id', $id)->where('usuario_id', session()->get('id'))->delete();
        
        $mensaje = $idioma==='en'?'Task deleted':'Tarea eliminada';
        return redirect()->back()->with('exito', $mensaje);
    }

    public function perfil()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $modelo = new UsuarioModel();
        $datos['usuario'] = $modelo->find(session()->get('id'));
        return view('perfil', $datos);
    }

    public function editar_usuario()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $modelo = new UsuarioModel();
        $datos['usuario'] = $modelo->find(session()->get('id'));
        return view('editar_usuario', $datos);
    }

    public function actualizar_usuario()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $id = session()->get('id');
        $modelo = new UsuarioModel();
        $correoNuevo = $this->request->getPost('correo');
        $existe = $modelo->where('correo', $correoNuevo)->where('id !=', $id)->first();
        
        if ($existe) {
            $mensaje = $idioma==='en'?'Email already in use':'El correo ya está en uso';
            return redirect()->back()->with('error', $mensaje);
        }

        $modelo->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'correo' => $correoNuevo
        ]);
        session()->set('nombre', $this->request->getPost('nombre'));
        session()->set('correo', $correoNuevo);
        $mensaje = $idioma==='en'?'Profile updated':'Perfil actualizado';
        return redirect()->to(base_url('perfil'))->with('exito', $mensaje);
    }

    public function subir_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $ruta = FCPATH . 'uploads';
        if (!is_dir($ruta)) {
            mkdir($ruta, 0777, true);
        }
        
        $archivo = $this->request->getFile('foto');
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $nombreNuevo = $archivo->getRandomName();
            $archivo->move($ruta, $nombreNuevo);
            $modelo = new UsuarioModel();
            $usuario = $modelo->find(session()->get('id'));
            if (!empty($usuario['foto']) && file_exists($ruta . '/' . $usuario['foto'])) {
                unlink($ruta . '/' . $usuario['foto']);
            }
            $modelo->update(session()->get('id'), ['foto' => $nombreNuevo]);
            $mensaje = $idioma==='en'?'Photo uploaded successfully':'Foto subida con éxito';
            session()->setFlashdata('exito', $mensaje);
        }
        return redirect()->back();
    }

    public function eliminar_foto()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new UsuarioModel();
        $usuario = $modelo->find(session()->get('id'));
        $ruta = FCPATH . 'uploads';
        if (!empty($usuario['foto']) && file_exists($ruta . '/' . $usuario['foto'])) {
            unlink($ruta . '/' . $usuario['foto']);
            $modelo->update(session()->get('id'), ['foto' => null]);
            $mensaje = $idioma==='en'?'Photo removed':'Foto eliminada';
            session()->setFlashdata('exito', $mensaje);
        }
        return redirect()->back();
    }

    public function cambiar_contrasena()
    {
        if (!session()->get('ingresado')) {
            return redirect()->to(base_url('ingresar'));
        }
        $idioma = session()->get('idioma_actual') ?? 'es';
        $modelo = new UsuarioModel();
        $usuario = $modelo->find(session()->get('id'));
        $actual = $this->request->getPost('contrasena_actual');
        $nueva = $this->request->getPost('contrasena_nueva');
        $confirmar = $this->request->getPost('confirmar_nueva');

        $pass = '';
        if (isset($usuario['contrasena'])) $pass = $usuario['contrasena'];
        elseif (isset($usuario['clave'])) $pass = $usuario['clave'];

        if (!password_verify($actual, $pass)) {
            $mensaje = $idioma==='en'?'Current password is incorrect':'Contraseña actual incorrecta';
            return redirect()->back()->with('error', $mensaje);
        }
        if ($nueva !== $confirmar) {
            $mensaje = $idioma==='en'?'Passwords do not match':'Las contraseñas no coinciden';
            return redirect()->back()->with('error', $mensaje);
        }

        $datos = [];
        if (isset($usuario['contrasena'])) {
            $datos['contrasena'] = password_hash($nueva, PASSWORD_DEFAULT);
        } elseif (isset($usuario['clave'])) {
            $datos['clave'] = password_hash($nueva, PASSWORD_DEFAULT);
        }

        if (!empty($datos)) {
            $modelo->update(session()->get('id'), $datos);
            $mensaje = $idioma==='en'?'Password updated':'Contraseña actualizada';
            session()->setFlashdata('exito', $mensaje);
        }
        return redirect()->back();
    }

    public function salir()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}