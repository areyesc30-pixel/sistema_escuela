<!DOCTYPE html>
<html lang= "es">
    <head>
        <meta charset="UTF-8">
        <title>Iniciar sesión - Sistema de Tareas</title>
        <style>
            
            body { font-family: Arial; max-width: 400px; margin:50px auto; padding: 20px;}
              .campo { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; font-size: 16px; }
        button { background: #007bff; color: white; border: none; padding: 10px; width: 100%; font-size: 16px; cursor: pointer; }
        .error { color: red; margin-bottom: 10px;}

        </style>
        </head>
        <body> <h1>Iniciar Sesión</h1>
        <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif ?>

    <form method="post" action="http://localhost/sistema_tareas/public/verificar">
        <div class="campo">
            <label>Correo electrónico:</label>
            <input type="email" name="correo" required>
        </div>

        <div class="campo">
            <label>Contraseña:</label>
            <input type="password" name="clave" required>
        </div>
        <button type="submit">Entrar</button>
        </form>
        </body>
        </html>
