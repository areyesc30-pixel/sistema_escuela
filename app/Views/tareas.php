<DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UFT-8">
            <title>Mis Tareas</title>
            <style>
                body { font-family: Arial; max-widith: 700px; margin: 30px auto; padding: 20px;}
                .salir { text-align: right; }
        .salir a { color: red; text-decoration: none; }
        form { background: #f5f5f5; padding: 20px; margin-bottom: 25px; border-radius: 8px; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0 15px 0; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #28a745; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; }
        .tarea { border-bottom: 1px solid #ddd; padding: 15px 0; }
        .hecha { text-decoration: line-through; color: #888; }
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
    
