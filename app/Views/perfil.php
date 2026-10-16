<!DOCTYPE html>
<html>
<head>
    <title>Mi Perfil</title>
    <style>
        body {
            background-color: #f7fafc;
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
            max-width: 450px;
            margin: 0 auto;
        }
        .tarjeta {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }
        h3 {
            color: #2f855a;
            margin-top: 0;
        }
        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
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
            background-color: #38a169;
            color: white;
            border: none;
            padding: 11px 22px;
            margin-top: 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
        }
        button:hover {
            background-color: #2f855a;
        }
        .mensaje {
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 8px;
            text-align: center;
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
        .dato {
            padding: 10px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .etiqueta {
            color: #718096;
            font-size: 14px;
        }
        .valor {
            color: #2d3748;
            font-weight: 500;
            margin-top: 4px;
        }
        .volver {
            text-align: center;
            margin-top: 20px;
        }
        .volver a {
            color: #2b6cb0;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <h1>Mi Perfil</h1>

    <div class="contenedor">
        <?php if (session()->getFlashdata('exito')): ?>
            <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <div class="tarjeta">
            <h3>Datos de la cuenta</h3>
            <div class="dato">
                <div class="etiqueta">Nombre</div>
                <div class="valor"><?= esc($usuario['nombre']) ?></div>
            </div>
            <div class="dato">
                <div class="etiqueta">Correo</div>
                <div class="valor"><?= esc($usuario['correo']) ?></div>
            </div>
            <div class="dato">
                <div class="etiqueta">Tipo de cuenta</div>
                <div class="valor"><?= $usuario['rol'] === 'admin' ? 'Administrador' : 'Usuario' ?></div>
            </div>
        </div>

        <div class="tarjeta">
            <h3>Cambiar Contraseña</h3>
            <form action="<?= base_url('cambiar-contrasena') ?>" method="post">
                <?= csrf_field() ?>

                <label>Contraseña actual:</label>
                <input type="password" name="contrasena_actual" required>

                <label>Contraseña nueva:</label>
                <input type="password" name="contrasena_nueva" required>

                <label>Confirmar contraseña nueva:</label>
                <input type="password" name="confirmar_nueva" required>

                <button type="submit">Actualizar Contraseña</button>
            </form>
        </div>

        <div class="volver">
            <a href="<?= base_url('tareas') ?>">← Volver a mis tareas</a>
        </div>
    </div>

</body>
</html>