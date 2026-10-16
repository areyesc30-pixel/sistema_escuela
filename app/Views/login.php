<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
        body {
            background-color: #cce0f5;
            font-family: Arial;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #1a2e44;
            text-align: center;
            margin-bottom: 30px;
        }

        .contenedor {
            background-color: white;
            padding: 25px;
            margin: 0 auto;
            max-width: 380px;
            border-radius: 8px;
            border: 1px solid #99b3cc;
        }

        label {
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #99b3cc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4a90e2;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #357abd;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
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



    </div>

</body>
</html>


