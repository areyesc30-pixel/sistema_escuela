<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
                    body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Arial;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #2b6cb0;
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
            color: #2c5282;
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
            border-color: #3182ce;
        }

        button {
            background-color: #3182ce;
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
            background-color: #2b6cb0;
        }

        .mensaje-error {
            background-color: #fff5f5;
            color: #c53030;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 3px solid #e53e3e;
        }

        .enlace {
            text-align: center;
            margin-top: 18px;
        }

        .enlace a {
            color: #2b6cb0;
            text-decoration: none;
        }

        .enlace a:hover {
            color: #2c5282;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Iniciar Sesión</h1>

    <div class="contenedor">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif ?>

        <form action="<?= base_url('ingresar') ?>" method="post">
            <?= csrf_field() ?>

            <label>Correo:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Entrar</button>
        </form>

        <p style="text-align: center; margin-top: 20px;">
        <a href="<?= base_url('recuperar-clave') ?>" style="color: #4a90e2;">¿Olvidaste tu contraseña?</a>
    </p>

        <p style="text-align: center; margin-top: 10px;">
            ¿No tienes cuenta? <a href="<?= base_url('registro') ?>" style="color: #4a90e2;">Regístrate aquí</a>
        </p>

    </div>

</body>
</html>


