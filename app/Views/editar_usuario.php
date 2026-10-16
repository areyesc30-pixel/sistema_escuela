<!DOCTYPE html>
<html>
<head>
    <title><?= ($lang ?? 'es') === 'en' ? 'Edit My Information' : 'Editar Mi Información' ?></title>
    <style>
        body {background: #f7fafc; font-family: Arial; margin: 0; padding: 20px;}
        .idioma {text-align: right; margin-bottom: 20px;}
        .idioma a {color: #2b6cb0; text-decoration: none; margin: 0 5px;}
        .idioma a.activo {font-weight: bold; border-bottom: 2px solid #2b6cb0;}
        h1 {color: #2b6cb0; text-align: center; margin-bottom: 30px;}
        .contenedor {max-width: 450px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);}
        label {display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold;}
        input {width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; font-size: 15px;}
        button {background: #38a169; color: white; border: none; padding: 12px 20px; margin-top: 10px; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%;}
        .volver {text-align: center; margin-top: 20px;}
        .volver a {color: #2b6cb0; text-decoration: none;}
        .mensaje {padding: 12px; margin-bottom: 20px; border-radius: 8px; text-align: center;}
        .error {background: #fff5f5; color: #c53030; border-left: 3px solid #e53e3e;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="idioma">
        <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
        <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
    </div>

    <div class="contenedor">
        <h1><?= $lang === 'en' ? 'Edit My Information' : 'Editar Mi Información' ?></h1>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <form action="<?= base_url('actualizar-usuario') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $lang === 'en' ? 'Full Name:' : 'Nombre Completo:' ?></label>
            <input type="text" name="nombre" value="<?= esc($usuario['nombre']) ?>" required>
            <label><?= $lang === 'en' ? 'Email Address:' : 'Correo Electrónico:' ?></label>
            <input type="email" name="correo" value="<?= esc($usuario['correo']) ?>" required>
            <button type="submit"><?= $lang === 'en' ? 'Save Changes' : 'Guardar Cambios' ?></button>
        </form>

        <div class="volver">
            <a href="<?= base_url('perfil') ?>">← <?= $lang === 'en' ? 'Back to Profile' : 'Volver al Perfil' ?></a>
        </div>
    </div>
</body>
</html>