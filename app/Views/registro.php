<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
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

        .mensaje {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        .exito {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #ffebee;
            color: #c62828;
        }

        .volver {
            text-align: center;
            margin-top: 15px;
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