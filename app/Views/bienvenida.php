<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 20px; }
        .caja { background: white; padding: 40px; border-radius: 12px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.05); width: 100%; max-width: 420px; }
        .idiomas { margin-bottom: 30px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        h1 { color: #2b6cb0; margin-bottom: 10px; font-size: 36px; }
        .subtitulo { color: #4a5568; margin-bottom: 30px; font-size: 20px; }
        .boton { display: block; padding: 15px; margin: 10px 0; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 18px; }
        .verde { background: #38a169; color: white; }
        .azul { background: #2b6cb0; color: white; }
    </style>
</head>
<body>
    <?php
    $idioma = session()->get('idioma_actual') ?? 'es';
    $textos = [
        'es' => [
            'bienvenido' => '¡Bienvenido!',
            'gestion' => 'Gestión de Tareas',
            'iniciar' => 'Iniciar Sesión',
            'crear' => 'Crear Cuenta'
        ],
        'en' => [
            'bienvenido' => 'Welcome!',
            'gestion' => 'Task Management',
            'iniciar' => 'Sign In',
            'crear' => 'Create Account'
        ]
    ];
    $t = $textos[$idioma];
    ?>
    <div class="caja">
        <div class="idiomas">
            <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma === 'es' ? 'activo' : 'inactivo' ?>">ES</a> | 
            <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma === 'en' ? 'activo' : 'inactivo' ?>">EN</a>
        </div>
        <h1><?= $t['bienvenido'] ?></h1>
        <p class="subtitulo"><?= $t['gestion'] ?></p>
        <a href="<?= base_url('ingresar') ?>" class="boton verde"><?= $t['iniciar'] ?></a>
        <a href="<?= base_url('registro') ?>" class="boton azul"><?= $t['crear'] ?></a>
    </div>
</body>
</html>