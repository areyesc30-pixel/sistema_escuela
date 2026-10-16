<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Gestión de Tareas</title>
    <style>
        body {background: #f0f4f8; font-family: Arial; margin: 0; padding: 0; height: 100vh; display: flex; align-items: center; justify-content: center;}
        .idioma {position: absolute; top: 20px; right: 20px;}
        .idioma a {color: #2b6cb0; text-decoration: none; margin: 0 5px;}
        .idioma a.activo {font-weight: bold; border-bottom: 2px solid #2b6cb0;}
        .contenedor {background: white; padding: 40px 50px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); max-width: 450px; text-align: center;}
        h1 {color: #2b6cb0; margin-bottom: 10px;}
        .subtitulo {color: #4a5568; margin-bottom: 35px;}
        .boton {display: block; text-decoration: none; padding: 12px; border-radius: 8px; font-size: 16px; font-weight: bold; margin-bottom: 15px;}
        .btn-ingresar {background: #38a169; color: white;}
        .btn-registrar {background: #4a90e2; color: white;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="idioma">
        <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
        <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
    </div>
    <div class="contenedor">
        <?php if ($lang === 'en'): ?>
            <h1>Welcome!</h1>
            <p class="subtitulo">Task Management System</p>
            <a href="<?= base_url('ingresar') ?>" class="boton btn-ingresar">Sign In</a>
            <a href="<?= base_url('registro') ?>" class="boton btn-registrar">Create Account</a>
        <?php else: ?>
            <h1>¡Bienvenido!</h1>
            <p class="subtitulo">Gestión de Tareas</p>
            <a href="<?= base_url('ingresar') ?>" class="boton btn-ingresar">Iniciar Sesión</a>
            <a href="<?= base_url('registro') ?>" class="boton btn-registrar">Crear Cuenta</a>
        <?php endif ?>
    </div>
</body>
</html>