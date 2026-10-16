<!DOCTYPE html>
<html>
<head>
    <title><?= ($lang ?? 'es') === 'en' ? 'Recover Password' : 'Recuperar Contraseña' ?></title>
    <style>
        body {background: #f0f4f8; font-family: Arial; margin: 0; padding: 0; height: 100vh; display: flex; align-items: center; justify-content: center;}
        .idioma {text-align: right; margin-bottom: 20px;}
        .idioma a {color: #2b6cb0; text-decoration: none; margin: 0 5px;}
        .idioma a.activo {font-weight: bold; border-bottom: 2px solid #2b6cb0;}
        .contenedor {background: white; padding: 35px 40px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 380px;}
        h2 {color: #2b6cb0; text-align: center; margin: 0 0 25px;}
        label {display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold;}
        input {width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; font-size: 15px;}
        button {width: 100%; background: #38a169; color: white; border: none; padding: 12px; margin-top: 20px; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer;}
        .enlaces {margin-top: 20px; text-align: center;}
        .enlaces a {color: #2b6cb0; text-decoration: none; display: block; margin: 8px 0;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="contenedor">
        <div class="idioma">
            <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
            <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
        </div>
        <h2><?= $lang === 'en' ? 'Recover Password' : 'Recuperar Contraseña' ?></h2>
        <form action="<?= base_url('enviar-recuperacion') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $lang === 'en' ? 'Enter your email:' : 'Ingresa tu correo:' ?></label>
            <input type="email" name="correo" required>
            <button type="submit"><?= $lang === 'en' ? 'Send Instructions' : 'Enviar Instrucciones' ?></button>
        </form>
        <div class="enlaces">
            <a href="<?= base_url('ingresar') ?>">← <?= $lang === 'en' ? 'Back to Login' : 'Volver al Inicio de Sesión' ?></a>
        </div>
    </div>
</body>
</html>
