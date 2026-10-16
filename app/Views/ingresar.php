<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title><?= (session()->get('idioma_actual')??'es')==='en'?'Sign In':'Iniciar Sesión' ?></title>
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
        button { width: 100%; background: #38a169; color: white; border: none; padding: 13px; border-radius: 8px; font-weight: bold; font-size: 16px; margin-top: 20px; cursor: pointer; }
        .mensaje { padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
        .exito { background: #f0fff4; color: #22543d; border-left: 4px solid #38a169; }
        .error { background: #fff5f5; color: #c53030; border-left: 4px solid #e53e3e; }
        .enlace { display: block; text-align: center; margin-top: 18px; color: #2b6cb0; text-decoration: none; }
        .volver { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <?php $idioma = session()->get('idioma_actual') ?? 'es'; ?>
    <div class="caja">
        <div class="idiomas">
            <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma==='es'?'activo':'inactivo' ?>">ES</a> |
            <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma==='en'?'activo':'inactivo' ?>">EN</a>
        </div>

        <h1><?= $idioma==='en'?'Sign In':'Iniciar Sesión' ?></h1>

        <?php if (session()->getFlashdata('exito')): ?>
            <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <form action="<?= base_url('entrar') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $idioma==='en'?'Email Address:':'Correo Electrónico:' ?></label>
            <input type="email" name="correo" required>
            
            <label><?= $idioma==='en'?'Password:':'Contraseña:' ?></label>
            <input type="password" name="clave" required>
            
            <button type="submit"><?= $idioma==='en'?'Sign In':'Ingresar' ?></button>
        </form>

        <a href="<?= base_url('recuperar-clave') ?>" class="enlace">
            <?= $idioma==='en'?'Forgot your password?':'¿Olvidaste tu contraseña?' ?>
        </a>
        <a href="<?= base_url('registro') ?>" class="enlace">
            <?= $idioma==='en'?'Create new account':'Crear cuenta nueva' ?>
        </a>
        <div class="volver">
            <a href="<?= base_url('/') ?>" style="color:#718096; font-size:14px; text-decoration:none;">← <?= $idioma==='en'?'Back':'Volver' ?></a>
        </div>
    </div>
</body>
</html>