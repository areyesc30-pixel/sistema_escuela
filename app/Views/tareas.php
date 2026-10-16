<DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UFT-8">
            <title>Mis Tareas</title>
            <style>
                        body {
            background: linear-gradient(135deg, #00C9FF, #92FE9D);
            min-height: 100vh;
            font-family: 'Segoe UI', Arial;
            margin: 0;
            padding: 20px;
        }

        .encabezado {
            background: white;
            padding: 25px 30px;
            margin-bottom: 25px;
            border-radius: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .encabezado h1 {
            margin: 0;
            color: #2c3e50;
        }

        .btn-salir {
            background: linear-gradient(90deg, #eb3349, #f45c43);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        .btn-salir:hover {
            transform: scale(1.05);
        }

        .formulario, .tarea {
            background: white;
            padding: 25px;
            margin-bottom: 18px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        h3 {
            color: #2c3e50;
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            color: #34495e;
            font-weight: 500;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            box-sizing: border-box;
            font-size: 15px;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #00C9FF;
        }

        button {
            background: linear-gradient(90deg, #00C9FF, #92FE9D);
            color: #2c3e50;
            border: none;
            padding: 12px 25px;
            margin-top: 18px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s;
        }

        button:hover {
            transform: scale(1.05);
        }

        .completada {
            text-decoration: line-through;
            color: #95a5a6;
        }

        .acciones a {
            margin-right: 15px;
            font-size: 15px;
            text-decoration: none;
            font-weight: 500;
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
        <style> 
        </head> 
        <body> 
        </div class="salir">
        <a href="<?=base_url('cerrar') ?>">Cerrar sesión</a>
        </div>

        <h1>Mis Tareas</h1> 
        <h3>Agregar tarea nueva</h3>
    <form method="post" action="<?= base_url('guardar-tarea') ?>">
        <input type="text" name="titulo" placeholder="Título de la tarea" required>
        <textarea name="descripcion" rows="3" placeholder="Descripción"></textarea>
        <button type="submit">Guardar</button>
    </form>

    <h3>Lista de tareas</h3>
    <?php if (empty($tareas)): ?>
        <p>No hay tareas todavía</p>
    <?php else: ?>
        <?php foreach ($tareas as $t): ?>
            <div class="tarea <?= $t['completada'] ? 'hecha' : '' ?>">
                <strong><?= $t['titulo'] ?></strong>
                <p><?= $t['descripcion'] ?></p>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    </body>
    </html>

