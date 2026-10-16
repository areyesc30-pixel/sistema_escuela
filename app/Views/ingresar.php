<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .contenedor {
            background: white;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 380px;
        }
        h2 {
            color: #2b6cb0;
            text-align: center;
            margin-top: 0;
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            margin-top: 15px;
            color: #4a5568;
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
            width: 100%;
            background-color: #38a169;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #2f855a;
        }
        .mensaje {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .error {
            background-color: #fff5f5;
            color: #c53030;
            border-left: 3px solid #fc8181;
        }
        .enlaces {
            margin-top: 20px;
            text-align: center;
        }
        .enlaces a {
            color: #2b6cb0;
            text-decoration: none;
            display: block;
            margin: 8px 0;
        }
        .enlaces a:hover {
            text-decoration: underline;
        }
        .volver {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Iniciar Sesión</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <form action="<?= base_url('entrar') ?>" method="post">
            <?= csrf_field() ?>

            <label>Correo electrónico:</label>
            <input type="email" name="correo" required>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>

            <button type="submit">Ingresar</button>
        </form>

        <div class="enlaces">
            <a href="<?= base_url('recuperar-clave') ?>">¿Olvidaste tu contraseña?</a>
            <a href="<?= base_url('registro') ?>">Crear cuenta nueva</a>
            <a href="<?= base_url('/') ?>" class="volver">← Volver</a>
        </div>
    </div>
</body>
</html>