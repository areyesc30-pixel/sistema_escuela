<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title><?= (session()->get('idioma_actual') ?? 'es') === 'en' ? 'Edit Task' : 'Editar Tarea' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; padding: 20px; }
        .cabecera { display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 15px 25px; border-radius: 12px; margin-bottom: 25px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        .form-editar { background: #ffffff; padding: 30px; border-radius: 12px; max-width: 500px; margin: 0 auto; }
        .form-editar h2 { color: #2b6cb0; margin-bottom: 25px; text-align: center; }
        label { display: block; margin: 15px 0 8px; color: #2f855a; font-weight: bold; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 15px; }
        .btn-guardar { background: #38a169; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; margin-top: 20px; cursor: pointer; width: 100%; }
        .btn-volver { display: block; text-align: center; margin-top: 20px; color: #718096; text-decoration: none; }
    </style>
</head>
<body>
<?php $idioma = session()->get('idioma_actual') ?? 'es'; ?>

<div class="cabecera">
    <div class="idiomas">
        <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma==='es'?'activo':'inactivo' ?>">ES</a> |
        <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma==='en'?'activo':'inactivo' ?>">EN</a>
    </div>
</div>

<div class="form-editar">
    <h2><?= $idioma==='en'?'Edit Task':'Editar Tarea' ?></h2>
    
    <form action="<?= base_url('actualizar-tarea/'.$tarea['id']) ?>" method="post">
        <?= csrf_field() ?>
        <label><?= $idioma==='en'?'Title:':'Título:' ?></label>
        <input type="text" name="titulo" value="<?= esc($tarea['titulo']) ?>" required>
        
        <label><?= $idioma==='en'?'Description:':'Descripción:' ?></label>
        <textarea name="descripcion" rows="4"><?= esc($tarea['descripcion']) ?></textarea>
        
        <button type="submit" class="btn-guardar"><?= $idioma==='en'?'Save Changes':'Guardar Cambios' ?></button>
    </form>
    
    <a href="<?= base_url('tareas') ?>" class="btn-volver">← <?= $idioma==='en'?'Back to tasks':'Volver a tareas' ?></a>
</div>

</body>
</html>