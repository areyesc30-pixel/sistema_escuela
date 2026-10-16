<!DOCTYPE html>
<html>
<head>
    <title>Mis Tareas</title>
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
        .btn-perfil {
            color: #2b6cb0;
            text-decoration: none;
            font-weight: 600;
            margin-right: 15px;
        }
        .btn-perfil:hover {
            color: #2c5282;
        }
        .btn-salir {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-salir:hover {
            background-color: #c0392b;
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
        input:focus, textarea:focus {
            outline: none;
            border-color: #3182ce;
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
        button:hover {
            background-color: #2f855a;
        }
        .completada {
            text-decoration: line-through;
            color: #888;
        }
        .acciones a {
            margin-right: 10px;
            font-size: 14px;
        }
        .editar {
            color: #ed8936;
        }
        .editar:hover {
            color: #dd6b20;
        }
        .completar {
            color: #27ae60;
        }
        .completar:hover {
            color: #219653;
        }
        .borrar {
            color: #e74c3c;
        }
        .borrar:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="encabezado">


    <?php if (session()->getFlashdata('exito')): ?>
        <div style="background:#f0fff4; color:#22543d; padding:12px; border-radius:8px; margin-bottom:20px; border-left:4px solid #48bb78;">
            <?= session()->getFlashdata('exito') ?>
        </div>
    <?php endif ?>





        <h1>Bienvenido, <?= $nombre ?></h1>
        <div>
            <a href="<?= base_url('perfil') ?>" class="btn-perfil">Mi Perfil</a>
            <a href="<?= base_url('salir') ?>" class="btn-salir">Cerrar sesión</a>
        </div>
    </div>

    <!-- BUSCADOR -->
    <div style="background:white; padding:18px; margin-bottom:20px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
        <form action="<?= base_url('tareas') ?>" method="get" style="display:flex; gap:10px; align-items:center;">
            <input type="text" name="buscar" placeholder="Buscar tarea..." 
                   style="flex:1; padding:11px; border:2px solid #e2e8f0; border-radius:8px; font-size:15px;"
                   value="<?= esc($busqueda ?? '') ?>">
            
            <button type="submit" style="margin:0; padding:11px 20px;">Buscar</button>
            
            <?php if (!empty($busqueda)): ?>
                <a href="<?= base_url('tareas') ?>" style="color:#e53e3e; text-decoration:none; font-weight:600;">Limpiar</a>
            <?php endif ?>
        </form>
    </div>

    <!-- MENSAJE DE RESULTADOS -->
    <?php if (!empty($busqueda)): ?>
        <p style="color:#4a5568; margin-bottom:15px;">
            Resultados para: <strong><?= esc($busqueda) ?></strong> — 
            <?= count($tareas) ?> tarea(s) encontrada(s)
        </p>
    <?php endif ?>

    <!-- AVISO SI NO HAY COINCIDENCIAS AL BUSCAR -->
    <?php if (empty($tareas) && !empty($busqueda)): ?>
        <p style="color:#e53e3e; text-align:center; padding:20px;">No se encontraron tareas con ese nombre.</p>
    <?php endif ?>

    <div class="formulario">
        <h3 style="color:#2b6cb0; margin-top:0;">Agregar nueva tarea</h3>
        <form action="<?= base_url('guardar-tarea') ?>" method="post">
            <?= csrf_field() ?>
            
            <label>Título:</label>
            <input type="text" name="titulo" required>
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3"></textarea>
            <button type="submit">Guardar tarea</button>
        </form>
    </div>

    <h3 style="color:#2b6cb0;">Mis Tareas</h3>
    <?php if (empty($tareas) && empty($busqueda)): ?>
        <p style="color:#4a5568;">No tienes tareas registradas. Agrega una arriba.</p>
    <?php else: ?>
        <?php foreach ($tareas as $tarea): ?>
            <div class="tarea">
                <h4 class="<?= $tarea['estado'] === 'completada' ? 'completada' : '' ?>" style="color:#2d3748; margin:0 0 8px 0;">
                    <?= esc($tarea['titulo']) ?>
                </h4>
                <p style="color:#4a5568; margin:0 0 8px 0;"><?= esc($tarea['descripcion']) ?></p>
                <small style="color:#718096;">Estado: <?= $tarea['estado'] ?></small>
                <div class="acciones" style="margin-top:10px;">
                    <a href="<?= base_url('editar-tarea/' . $tarea['id']) ?>" class="editar">Editar</a>
                    <?php if ($tarea['estado'] !== 'completada'): ?>
                        <a href="<?= base_url('completar/' . $tarea['id']) ?>" class="completar">Marcar completada</a>
                    <?php endif ?>
                    <a href="<?= base_url('eliminar/' . $tarea['id']) ?>" class="borrar" onclick="return confirm('¿Seguro que quieres borrarla?')">Eliminar</a>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</body>
</html>