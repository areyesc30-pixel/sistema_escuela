<!DOCTYPE html>
<html>
<head>
    <title><?= ($lang ?? 'es') === 'en' ? 'My Profile' : 'Mi Perfil' ?></title>
    <style>
        body {background: #f7fafc; font-family: Arial; margin: 0; padding: 20px;}
        .idioma {text-align: right; margin-bottom: 20px;}
        .idioma a {color: #2b6cb0; text-decoration: none; margin: 0 5px;}
        .idioma a.activo {font-weight: bold; border-bottom: 2px solid #2b6cb0;}
        h1 {color: #2b6cb0; text-align: center; margin-bottom: 30px;}
        .contenedor {max-width: 450px; margin: 0 auto;}
        .bloque {background: white; padding: 25px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);}
        h3 {color: #2f855a; margin-top: 0;}
        label {display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold;}
        input {width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; font-size: 15px;}
        button {background: #38a169; color: white; border: none; padding: 11px 22px; margin-top: 18px; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%;}
        .btn-rojo {background: #e53e3e;}
        .mensaje {padding: 14px; margin-bottom: 20px; border-radius: 8px; text-align: center;}
        .exito {background: #f0fff4; color: #22543d; border-left: 3px solid #48bb78;}
        .error {background: #fff5f5; color: #c53030; border-left: 3px solid #e53e3e;}
        .dato {padding: 10px 0; border-bottom: 1px solid #e2e8f0;}
        .etiqueta {color: #718096; font-size: 14px;}
        .valor {color: #2d3748; font-weight: bold; margin-top: 4px;}
        .volver {text-align: center; margin-top: 20px;}
        .volver a {color: #2b6cb0; text-decoration: none;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="idioma">
        <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
        <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
    </div>
    <h1><?= $lang === 'en' ? 'My Profile' : 'Mi Perfil' ?></h1>
    <div class="contenedor">
        <?php if (session()->getFlashdata('exito')): ?>
            <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>
        <div class="bloque">
            <h3><?= $lang === 'en' ? 'Account Information' : 'Datos de la Cuenta' ?></h3>
            <div class="dato">
                <div class="etiqueta"><?= $lang === 'en' ? 'Full Name' : 'Nombre Completo' ?></div>
                <div class="valor"><?= esc($usuario['nombre']) ?></div>
            </div>
            <div class="dato">
                <div class="etiqueta"><?= $lang === 'en' ? 'Email' : 'Correo' ?></div>
                <div class="valor"><?= esc($usuario['correo']) ?></div>
            </div>
            <div class="dato">
                <div class="etiqueta"><?= $lang === 'en' ? 'Role' : 'Rol' ?></div>
                <div class="valor"><?= $usuario['rol'] === 'admin' ? ($lang === 'en' ? 'Administrator' : 'Administrador') : ($lang === 'en' ? 'User' : 'Usuario') ?></div>
            </div>
        </div>
        <div class="bloque">
            <h3><?= $lang === 'en' ? 'Change Password' : 'Cambiar Contraseña' ?></h3>
            <form action="<?= base_url('cambiar-contrasena') ?>" method="post">
                <?= csrf_field() ?>
                <label><?= $lang === 'en' ? 'Current Password:' : 'Contraseña Actual:' ?></label>
                <input type="password" name="contrasena_actual" required>
                <label><?= $lang === 'en' ? 'New Password:' : 'Contraseña Nueva:' ?></label>
                <input type="password" name="contrasena_nueva" required>
                <label><?= $lang === 'en' ? 'Confirm New Password:' : 'Confirmar Contraseña:' ?></label>
                <input type="password" name="confirmar_nueva" required>
                <button type="submit"><?= $lang === 'en' ? 'Update Password' : 'Actualizar Contraseña' ?></button>
            </form>
        </div>
        <div class="volver">
            <a href="<?= base_url('tareas') ?>">← <?= $lang === 'en' ? 'Back to My Tasks' : 'Volver a Mis Tareas' ?></a>
        </div>
    </div>
</body>
</html>