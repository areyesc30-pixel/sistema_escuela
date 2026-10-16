<!DOCTYPE html>
<html>
<head>
    <title><?= (session()->get('idioma') ?? 'es') === 'en' ? 'My Tasks' : 'Mis Tareas' ?></title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial;
            margin: 0;
            padding: 20px;
        }
        .encabezado {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .encabezado h1 {
            margin: 0;
            color: #2b6cb0;
            font-size: 22px;
        }
        .idioma a {
            color: #2b6cb0;
            text-decoration: none;
            margin: 0 5px;
        }
        .idioma a.activo {
            font-weight: bold;
            border-bottom: 2px solid #2b6cb0;
        }
        .btn-perfil {
            color: #2b6cb0;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
        }
        .btn-salir {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
        }
        .mensaje-exito {
            background: #f0fff4;
            color: #22543d;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #48bb78;
        }
        .buscador {
            background:white;
            padding:18px;
            margin-bottom:20px;
            border-radius:10px;
        }
        .buscador input {
            flex:1;
            padding:11px;
            border:2px solid #e2e8f0;
            border-radius:8px;
            font-size:15px;
        }
        .buscador button {
            padding:11px 20px;
            background:#38a169;
            color:white;
            border:none;
            border-radius:8px;
            cursor:pointer;
        }
        .formulario, .tarea {
            background-color: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #2f855a;
            font-weight: 500;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #38a169;
            color: white;
            border: none;
            padding: 10px 20px;
            margin-top: 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .completada {
            text-decoration: line-through;
            color: #888;
        }
        .acciones a {
            margin-right: 10px;
            font-size: 14px;
        }
        .editar { color: #ed8936; }
        .completar { color: #27ae60; }
        .borrar { color: #e74c3c; }
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>

    <div class="encabezado">
        <div class="idioma">
            <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
            <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
        </div>
        <h1><?= $lang === 'en' ? 'Welcome, ' : 'Bienvenido, ' ?><?= $nombre ?></h1>
        <div>
            <a href="<?= base_url('perfil') ?>" class="btn-perfil"><?= $lang === 'en' ? 'Profile' : 'Mi Perfil' ?></a>
            <a href="<?= base_url('salir') ?>" class="btn-salir"><?= $lang === 'en' ? 'Log Out' : 'Cerrar sesión' ?></a>
        </div>
    </div>

    <?php if (session()->getFlashdata('exito')): ?>
        <div class="mensaje-exito"><?= session()->getFlashdata('exito') ?></div>
    <?php endif ?>

    <div class="buscador">
        <form action="<?= base_url('tareas') ?>" method="get" style="display:flex; gap:10px; align-items:center;">
            <input type="text" name="buscar" placeholder="<?= $lang === 'en' ? 'Search task...' : 'Buscar tarea...' ?>" 
                   value="<?= esc($busqueda ?? '') ?>">
            <button type="submit"><?= $lang === 'en' ? 'Search' : 'Buscar' ?></button>
            <?php if (!empty($busqueda)): ?>
                <a href="<?= base_url('tareas') ?>" style="color:#e53e3e; text-decoration:none; font-weight:600;">
                    <?= $lang === 'en' ? 'Clear' : 'Limpiar' ?>
                </a>
            <?php endif ?>
        </form>
    </div>

    <?php if (!empty($busqueda)): ?>
        <p style="color:#4a5568;">
            <?= $lang === 'en' ? 'Results for:' : 'Resultados para:' ?> <strong><?= esc($busqueda) ?></strong> — 
            <?= count($tareas) ?> <?= $lang === 'en' ? 'task(s) found' : 'tarea(s) encontrada(s)' ?>
        </p>
    <?php endif ?>

    <?php if (empty($tareas) && !empty($busqueda)): ?>
        <p style="color:#e53e3e; text-align:center; padding:20px;">
            <?= $lang === 'en' ? 'No tasks found.' : 'No se encontraron tareas con ese nombre.' ?>
        </p>
    <?php endif ?>

    <div class="formulario">
        <h3 style="color:#2b6cb0; margin-top:0;"><?= $lang === 'en' ? 'Add New Task' : 'Agregar Nueva Tarea' ?></h3>
        <form action="<?= base_url('guardar-tarea') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $lang === 'en' ? 'Title:' : 'Título:' ?></label>
            <input type="text" name="titulo" required>
            <label><?= $lang === 'en' ? 'Description:' : 'Descripción:' ?></label>
            <textarea name="descripcion" rows="3"></textarea>
            <button type="submit"><?= $lang === 'en' ? 'Save Task' : 'Guardar tarea' ?></button>
        </form>
    </div>

    <h3 style="color:#2b6cb0;"><?= $lang === 'en' ? 'My Tasks' : 'Mis Tareas' ?></h3>
    <?php if (empty($tareas) && empty($busqueda)): ?>
        <p style="color:#4a5568;"><?= $lang === 'en' ? 'No tasks registered. Add one above.' : 'No tienes tareas registradas. Agrega una arriba.' ?></p>
    <?php else: ?>
        <?php foreach ($tareas as $tarea): ?>
            <div class="tarea">
                <h4 class="<?= $tarea['estado'] === 'completada' ? 'completada' : '' ?>" style="color:#2d3748; margin:0 0 8px 0;">
                    <?= esc($tarea['titulo']) ?>
                </h4>
                <p style="color:#4a5568; margin:0 0 8px 0;"><?= esc($tarea['descripcion']) ?></p>
                <small style="color:#718096;"><?= $lang === 'en' ? 'Status:' : 'Estado:' ?> <?= $tarea['estado'] ?></small>
                <div class="acciones" style="margin-top:10px;">
                    <a href="<?= base_url('editar-tarea/' . $tarea['id']) ?>" class="editar"><?= $lang === 'en' ? 'Edit' : 'Editar' ?></a>
                    <?php if ($tarea['estado'] !== 'completada'): ?>
                        <a href="<?= base_url('completar/' . $tarea['id']) ?>" class="completar"><?= $lang === 'en' ? 'Mark Completed' : 'Marcar completada' ?></a>
                    <?php endif ?>
                    <a href="<?= base_url('eliminar/' . $tarea['id']) ?>" class="borrar" onclick="return confirm('<?= $lang === 'en' ? 'Are you sure?' : '¿Seguro que quieres borrarla?' ?>')">
                        <?= $lang === 'en' ? 'Delete' : 'Eliminar' ?>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</body>
</html>