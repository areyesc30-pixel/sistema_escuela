<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title><?= (session()->get('idioma_actual') ?? 'es') === 'en' ? 'Task Management' : 'Gestión de Tareas' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; padding: 20px; }
        .cabecera { display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 15px 25px; border-radius: 12px; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        .nombre { font-size: 20px; font-weight: bold; color: #2b6cb0; }
        .acciones { display: flex; align-items: center; gap: 15px; flex-wrap: wrap; }
        .foto-perfil { width: 45px; height: 45px; border-radius: 50%; overflow: hidden; border: 2px solid #2b6cb0; }
        .foto-perfil img { width: 100%; height: 100%; object-fit: cover; }
        .foto-perfil .sin-foto { width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .link-perfil { color: #2b6cb0; text-decoration: none; font-weight: bold; }
        .btn-cerrar { background: #e53e3e; color: white; padding: 8px 18px; border-radius: 6px; text-decoration: none; font-weight: bold; border: none; cursor: pointer; }
        .mensaje { padding: 14px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid; }
        .exito { background: #f0fff4; color: #22543d; border-color: #38a169; }
        .error { background: #fff5f5; color: #c53030; border-color: #e53e3e; }
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
        .tarea.completada { opacity: 0.7; border-left: 4px solid #38a169; }
        .tarea h3 { margin-bottom: 8px; color: #2d3748; }
        .tarea p { margin-bottom: 10px; color: #4a5568; }
        .estado { font-size: 14px; margin-bottom: 12px; font-weight: bold; }
        .pendiente { color: #d69e2e; }
        .completada { color: #38a169; }
        .enlace-editar { color: #ed8936; text-decoration: none; margin-right: 10px; font-weight: bold; }
        .enlace-completar { color: #38a169; text-decoration: none; margin-right: 10px; font-weight: bold; }
        .enlace-eliminar { color: #e53e3e; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<?php
$idioma = session()->get('idioma_actual') ?? 'es';
$textos = [
    'es' => [
        'bienvenido' => 'Bienvenido, ' . esc(session()->get('nombre')),
        'mi_perfil' => 'Mi Perfil',
        'cerrar_sesion' => 'Cerrar sesión',
        'buscar' => 'Buscar tarea...',
        'btn_buscar' => 'Buscar',
        'agregar_tarea' => 'Agregar Nueva Tarea',
        'titulo' => 'Título:',
        'descripcion' => 'Descripción:',
        'guardar' => 'Guardar tarea',
        'mis_tareas' => 'Mis Tareas',
        'no_tareas' => 'No tienes tareas guardadas aún.',
        'pendiente' => 'Pendiente',
        'completada' => 'Completada',
        'editar' => 'Editar',
        'completar' => 'Marcar completada',
        'eliminar' => 'Eliminar'
    ],
    'en' => [
        'bienvenido' => 'Welcome, ' . esc(session()->get('nombre')),
        'mi_perfil' => 'My Profile',
        'cerrar_sesion' => 'Log out',
        'buscar' => 'Search task...',
        'btn_buscar' => 'Search',
        'agregar_tarea' => 'Add New Task',
        'titulo' => 'Title:',
        'descripcion' => 'Description:',
        'guardar' => 'Save task',
        'mis_tareas' => 'My Tasks',
        'no_tareas' => 'You have no saved tasks yet.',
        'pendiente' => 'Pending',
        'completada' => 'Completed',
        'editar' => 'Edit',
        'completar' => 'Mark completed',
        'eliminar' => 'Delete'
    ]
];
$t = $textos[$idioma];
?>

<div class="cabecera">
    <div class="idiomas">
        <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma === 'es' ? 'activo' : 'inactivo' ?>">ES</a> | 
        <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma === 'en' ? 'activo' : 'inactivo' ?>">EN</a>
    </div>
    <div class="nombre"><?= $t['bienvenido'] ?></div>
    <div class="acciones">
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
        <a href="<?= base_url('perfil') ?>" class="link-perfil"><?= $t['mi_perfil'] ?></a>
        <a href="<?= base_url('salir') ?>" class="btn-cerrar"><?= $t['cerrar_sesion'] ?></a>
    </div>
</div>

<?php if (session()->getFlashdata('exito')): ?>
    <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="buscador">
    <input type="text" placeholder="<?= $t['buscar'] ?>">
    <button class="btn-buscar"><?= $t['btn_buscar'] ?></button>
</div>

<div class="form-agregar">
    <h2><?= $t['agregar_tarea'] ?></h2>
    <form action="<?= base_url('guardar-tarea') ?>" method="post">
        <?= csrf_field() ?>
        <label><?= $t['titulo'] ?></label>
        <input type="text" name="titulo" required>
        <label><?= $t['descripcion'] ?></label>
        <textarea name="descripcion" rows="4"></textarea>
        <button type="submit" class="btn-guardar"><?= $t['guardar'] ?></button>
    </form>
</div>

<div class="lista">
    <h2><?= $t['mis_tareas'] ?></h2>
    <?php if (empty($tareas)): ?>
        <p style="color: #718096; padding: 15px;"><?= $t['no_tareas'] ?></p>
    <?php else: ?>
        <?php foreach ($tareas as $tarea): ?>
            <?php 
            $esCompletada = (strpos($tarea['estado'], 'Completada') !== false || strpos($tarea['estado'], 'Completed') !== false);
            $claseEstado = $esCompletada ? 'completada' : 'pendiente';
            $textoEstado = $esCompletada ? $t['completada'] : $t['pendiente'];
            $claseTarea = $esCompletada ? 'tarea completada' : 'tarea';
            ?>
            <div class="<?= $claseTarea ?>">
                <h3><?= esc($tarea['titulo']) ?></h3>
                <p><?= esc($tarea['descripcion']) ?></p>
                <div class="estado <?= $claseEstado ?>">Estado: <?= $textoEstado ?></div>
                <?php if (!$esCompletada): ?>
                    <a href="<?= base_url('editar-tarea/'.$tarea['id']) ?>" class="enlace-editar"><?= $t['editar'] ?></a>
                    <a href="<?= base_url('completar-tarea/'.$tarea['id']) ?>" class="enlace-completar"><?= $t['completar'] ?></a>
                <?php endif; ?>
                <a href="<?= base_url('eliminar-tarea/'.$tarea['id']) ?>" class="enlace-eliminar" onclick="return confirm('<?= $idioma==='en'?'Delete this task?':'¿Eliminar esta tarea?' ?>')"><?= $t['eliminar'] ?></a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

</body>
</html>