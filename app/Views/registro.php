<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title><?= (session()->get('idioma_actual')??'es')==='en'?'Create Account':'Crear Cuenta' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .caja { background: white; padding: 35px; border-radius: 12px; width: 100%; max-width: 420px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .idiomas { text-align: right; margin-bottom: 20px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        h1 { text-align: center; color: #2b6cb0; margin-bottom: 25px; font-size: 26px; }
        label { display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold; }
        input { width: 100%; padding: 12px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; }
        button { width: 100%; background: #2b6cb0; color: white; border: none; padding: 13px; border-radius: 8px; font-weight: bold; font-size: 16px; margin-top: 20px; cursor: pointer; }
        .mensaje { padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .error { background: #fff5f5; color: #c53030; border-left: 4px solid #e53e3e; }
        .enlace { display: block; text-align: center; margin-top: 18px; color: #2b6cb0; text-decoration: none; }
    </style>
</head>
<body>
    <?php $idioma = session()->get('idioma_actual') ?? 'es'; ?>
    <div class="caja">
        <div class="idiomas">
            <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma==='es'?'activo':'inactivo' ?>">ES</a> |
            <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma==='en'?'activo':'inactivo' ?>">EN</a>
        </div>

        <h1><?= $idioma==='en'?'Create Account':'Crear Cuenta' ?></h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <form action="<?= base_url('registrar') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $idioma==='en'?'Full Name:':'Nombre Completo:' ?></label>
            <input type="text" name="nombre" required>
            
            <label><?= $idioma==='en'?'Email Address:':'Correo Electrónico:' ?></label>
            <input type="email" name="correo" required>
            
            <label><?= $idioma==='en'?'Password:':'Contraseña:' ?></label>
            <input type="password" name="clave" required>
            
            <button type="submit"><?= $idioma==='en'?'Register':'Registrarse' ?></button>
        </form>

        <a href="<?= base_url('ingresar') ?>" class="enlace">
            ← <?= $idioma==='en'?'Back to Sign In':'Volver a Iniciar Sesión' ?>
        </a>
    </div>
</body>
</html>