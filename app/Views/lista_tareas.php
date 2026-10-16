<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; padding: 20px; }
        .cabecera { display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 15px 25px; border-radius: 12px; margin-bottom: 25px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        .nombre { font-size: 22px; font-weight: bold; color: #2b6cb0; }
        .acciones { display: flex; align-items: center; gap: 15px; }
        .foto-perfil { width: 45px; height: 45px; border-radius: 50%; overflow: hidden; border: 2px solid #2b6cb0; }
        .foto-perfil img { width: 100%; height: 100%; object-fit: cover; }
        .foto-perfil .sin-foto { width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .link-perfil { color: #2b6cb0; text-decoration: none; font-weight: bold; }
        .btn-cerrar { background: #e53e3e; color: white; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; }
        .buscador { display: flex; gap: 10px; margin-bottom: 25px; }
        .buscador input { flex: 1; padding: 12px 15px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 15px; }
        .btn-buscar { background: #38a169; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; }
        .form-agregar { background: #ffffff; padding: 25px; border-radius: 12px; margin-bottom: 30px; }
        .form-agregar h2 { color: #2b6cb0; margin-bottom: 20px; font-size: 20px; }
        .form-agregar label { display: block; margin: 15px 0 8px; color: #2f855a; font-weight: bold; }
        .form-agregar input, .form-agregar textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 15px; }
        .btn-guardar { background: #38a169; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; margin-top: 20px; cursor: pointer; }
        .lista h2 { font-size: 18px; margin-bottom: 20px; color: #2d3748; }
        .tarea { background: #ffffff; padding: 20px; border-radius: 10px; margin-bottom: 15px; }
        .tarea h3 { margin-bottom: 8px; color: #2d3748; }
        .tarea p { margin-bottom: 10px; color: #4a5568; }
        .estado { color: #d69e2e; font-size: 14px; margin-bottom: 12px; }
        .enlace-editar { color: #ed8936; text-decoration: none; margin-right: 10px; }
        .enlace-completar { color: #38a169; text-decoration: none; margin-right: 10px; }
        .enlace-eliminar { color: #e53e3e; text-decoration: none; }
    </style>
</head>
<body>

<!-- CABECERA CON FOTO DE PERFIL -->
<div class="cabecera">
    <div class="idiomas">
        <a href="#" class="activo">ES</a> | <a href="#" class="inactivo">EN</a>
    </div>
    
    <div class="nombre">
        Bienvenido, ALEX FERNANDO REYES CURUP
    </div>
    
    <div class="acciones">
        <!-- FOTO DE PERFIL EN LA ESQUINA -->
        <div class="foto-perfil">
            <?php 
            $usuarioModel = model('UsuarioModel');
            $usuario = $usuarioModel->find(session()->get('id'));
            if (!empty($usuario['foto'])): 
            ?>
                <img src="<?= base_url() ?>uploads/<?= $usuario['foto'] ?>" alt="Foto de perfil">
            <?php else: ?>
                <div class="sin-foto">👤</div>
            <?php endif; ?>
        </div>
        
        <a href="<?= base_url('perfil') ?>" class="link-perfil">Mi Perfil</a>
        <a href="<?= base_url('salir') ?>" class="btn-cerrar">Cerrar sesión</a>
    </div>
</div>

<!-- BUSCADOR -->
<div class="buscador">
    <input type="text" placeholder="Buscar tarea...">
    <button class="btn-buscar">Buscar</button>
</div>

<!-- FORMULARIO AGREGAR TAREA -->
<div class="form-agregar">
    <h2>Agregar Nueva Tarea</h2>
    <form action="<?= base_url('guardar-tarea') ?>" method="post">
        <label>Título:</label>
        <input type="text" name="titulo" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion" rows="4"></textarea>
        
        <button type="submit" class="btn-guardar">Guardar tarea</button>
    </form>
</div>

<!-- LISTA DE TAREAS -->
<div class="lista">
    <h2>Mis Tareas</h2>
    
    <div class="tarea">
        <h3>Tarea de precálculo</h3>
        <p>Tarea de la semana 2</p>
        <div class="estado">Estado: Pendiente</div>
        <a href="#" class="enlace-editar">Editar</a>
        <a href="#" class="enlace-completar">Marcar completada</a>
        <a href="#" class="enlace-eliminar">Eliminar</a>
    </div>
</div>

</body>
</html>