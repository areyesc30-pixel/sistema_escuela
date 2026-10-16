<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
    <style>
                body {
            background-color: #faf5f0;
            font-family: 'Segoe UI', Arial;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #c05621;
            text-align: center;
            margin-bottom: 30px;
        }

        .contenedor {
            background: white;
            padding: 30px;
            margin: 0 auto;
            max-width: 400px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        label {
            display: block;
            margin-bottom: 6px;
            margin-top: 18px;
            color: #9c4221;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #ed8936;
        }

        button {
            background-color: #ed8936;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 25px;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
        }

        button:hover {
            background-color: #dd6b20;
        }

        .mensaje {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .exito {
            background-color: #f0fff4;
            color: #22543d;
            border-left: 3px solid #48bb78;
        }

        .error {
            background-color: #fff5f5;
            color: #c53030;
            border-left: 3px solid #e53e3e;
        }

        .volver {
            text-align: center;
            margin-top: 20px;
        }

        .volver a {
            color: #ed8936;
            text-decoration: none;
        }

        .volver a:hover {
            color: #c05621;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Crear Cuenta Nueva</h1>

    <div class="contenedor">
        <?php if (session()->getFlashdata('exito')): ?>
            <div class="mensaje exito">
                <?= session()->getFlashdata('exito') ?>
            </div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('guardar-registro') ?>" method="post">
            <?= csrf_field() ?>

            <label>Nombre completo:</label>
            <input type="text" name="nombre" required>

            <label>Correo electrónico:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Registrarme</button>
        </form>

        <div class="volver">
            <a href="<?= base_url('/') ?>">Ya tengo cuenta → Iniciar sesión</a>
        </div>
    </div>

</body>
</html>