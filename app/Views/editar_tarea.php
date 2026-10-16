<!DOCTYPE html>
<html>
<head>
    <title><?= ($lang ?? 'es') === 'en' ? 'Edit Task' : 'Editar Tarea' ?></title>
    <style>
        body {background: #f0f4f8; font-family: Arial; margin: 0; padding: 20px;}
        .contenedor {max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);}
        h2 {color: #2b6cb0; text-align: center; margin-top: 0;}
        label {display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold;}
        input, textarea {width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; font-size: 15px;}
        button {background: #38a169; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; font-size: 16px; font-weight: bold; width: 100%; margin-top: 10px;}
        .volver {text-align: center; margin-top: 20px;}
        .volver a {color: #2b6cb0; text-decoration: none;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="contenedor">
        <h2><?= $lang === 'en' ? 'Edit Task' : 'Editar Tarea' ?></h2>
        <form action="<?= base_url('actualizar-tarea/' . $tarea['id']) ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $lang === 'en' ? 'Title:' : 'Título:' ?></label>
            <input type="text" name="titulo" value="<?= esc($tarea['titulo']) ?>" required>
            <label><?= $lang === 'en' ? 'Description:' : 'Descripción:' ?></label>
            <textarea name="descripcion" rows="4"><?= esc($tarea['descripcion']) ?></textarea>
            <button type="submit"><?= $lang === 'en' ? 'Update Task' : 'Actualizar Tarea' ?></button>
        </form>
        <div class="volver">
            <a href="<?= base_url('tareas') ?>">← <?= $lang === 'en' ? 'Back to My Tasks' : 'Volver a Mis Tareas' ?></a>
        </div>
    </div>
</body>
</html>