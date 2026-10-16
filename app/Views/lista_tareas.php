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
        .btn-salir {
            background-color: #e74c3c;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 4px;
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
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4a90e2;
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
        .editar {
            color: #ed8936;
        }
        .editar:hover {
            color: #dd6b20;
        }
        .completar {
            color: #27ae60;
        }
        .borrar {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="encabezado">
        <h1>Bienvenido, <?= $nombre ?></h1>
        <a href="<?= base_url('salir') ?>" class="btn-salir">Cerrar sesión</a>
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
        <h3>Agregar nueva tarea</h3>
        <form action="<?= base_url('guardar-tarea') ?>" method="post">
            <?= csrf_field() ?>
            
            <label>Título:</label>
            <input type="text" name="titulo" required>
            <label>Descripción:</label>
            <textarea name="descripcion" rows="3"></textarea>
            <button type="submit">Guardar tarea</button>
        </form>
    </div>

    <h3>Mis Tareas</h3>
    <?php if (empty($tareas) && empty($busqueda)): ?>
        <p>No tienes tareas registradas. Agrega una arriba.</p>
    <?php else: ?>
        <?php foreach ($tareas as $tarea): ?>
            <div class="tarea">
                <h4 class="<?= $tarea['estado'] === 'completada' ? 'completada' : '' ?>">
                    <?= esc($tarea['titulo']) ?>
                </h4>
                <p><?= esc($tarea['descripcion']) ?></p>
                <small>Estado: <?= $tarea['estado'] ?></small>
                <div class="acciones">
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