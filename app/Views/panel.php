<DOCTYPE html>
    <html lang="es">
        <head>
            <meta charset="UFT-8">
            <title>Panel - Sistema de Tareas</title>
            <style>
    body { font-family: Arial; max-width: 800px; margin: 30px auto; padding: 20px; }
        .salir { text-align: right; }
        .salir a { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <div class="salir">
        <a href="<?= base_url('cerrar') ?>">Cerrar sesión</a>
    </div>

    <h1>Bienvenido, <?= session()->get('nombre') ?> </h1>
    <p>Estás dentro del sistema de tareas escolares.</p>

    <?php if (session()->get('es_admin')): ?>
        <p><strong>Eres administrador del sistema </strong></p>
    <?php endif ?>
    
    <hr>
    <h3>Próximamente: tus tareas</h3>
    </body>
    </html>

    