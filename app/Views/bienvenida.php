<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Gestión de Tareas</title>
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
            text-align: center;
            background: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 450px;
        }
        h1 {
            color: #2b6cb0;
            margin-bottom: 10px;
        }
        .subtitulo {
            color: #4a5568;
            margin-bottom: 35px;
        }
        .boton {
            display: block;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            transition: 0.2s;
        }
        .btn-ingresar {
            background-color: #38a169;
            color: white;
        }
        .btn-ingresar:hover {
            background-color: #2f855a;
        }
        .btn-registrar {
            background-color: #4a90e2;
            color: white;
        }
        .btn-registrar:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>¡Bienvenido!</h1>
        <p class="subtitulo">Sistema de Gestión de Tareas</p>

        <a href="<?= base_url('ingresar') ?>" class="boton btn-ingresar">Iniciar Sesión</a>
        <a href="<?= base_url('registro') ?>" class="boton btn-registrar">Crear Cuenta</a>
    </div>
</body>
</html>