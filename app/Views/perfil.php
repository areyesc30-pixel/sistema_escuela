<!DOCTYPE html>
<html>
<head>
    <title><?= ($lang ?? 'es') === 'en' ? 'My Profile' : 'Mi Perfil' ?></title>
    <style>
        body {background: #f7fafc; font-family: Arial; margin: 0; padding: 20px;}
        .idioma {text-align: right; margin-bottom: 20px;}
        .idioma a {color: #2b6cb0; text-decoration: none; margin: 0 5px;}
        .idioma a.activo {font-weight: bold; border-bottom: 2px solid #2b6cb0;}
        h1 {color: #2b6cb0; text-align: center; margin-bottom: 30px;}
        .contenedor {max-width: 480px; margin: 0 auto;}
        .bloque {background: white; padding: 25px; margin-bottom: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.06);}
        h3 {color: #2f855a; margin-top: 0;}
        .foto {width: 130px; height: 130px; border-radius: 50%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; overflow: hidden;}
        .foto img {width: 100%; height: 100%; object-fit: cover;}
        .foto span {font-size: 50px; color: #a0aec0;}
        label {display: block; margin: 15px 0 6px; color: #4a5568; font-weight: bold;}
        input {width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; box-sizing: border-box; font-size: 15px;}
        button {background: #38a169; color: white; border: none; padding: 11px 22px; margin-top: 10px; border-radius: 8px; cursor: pointer; font-weight: bold; width: 100%;}
        .btn-rojo {background: #e53e3e;}
        .mensaje {padding: 14px; margin-bottom: 20px; border-radius: 8px; text-align: center;}
        .exito {background: #f0fff4; color: #22543d; border-left: 3px solid #48bb78;}
        .error {background: #fff5f5; color: #c53030; border-left: 3px solid #e53e3e;}
        .volver {text-align: center; margin-top: 20px;}
        .volver a {color: #2b6cb0; text-decoration: none;}
    </style>
</head>
<body>
    <?php $lang = session()->get('idioma') ?? 'es'; ?>
    <div class="idioma">
        <a href="<?= base_url('idioma/es') ?>" class="<?= $lang === 'es' ? 'activo' : '' ?>">ES</a> |
        <a href="<?= base_url('idioma/en') ?>" class="<?= $lang === 'en' ? 'activo' : '' ?>">EN</a>
    </div>

    <h1><?= $lang === 'en' ? 'My Profile' : 'Mi Perfil' ?></h1>
    <div class="contenedor">
        <?php if (session()->getFlashdata('exito')): ?>
            <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
        <?php endif ?>

        <div class="bloque">
            <h3><?= $lang === 'en' ? 'Profile Photo' : 'Foto de Perfil' ?></h3>
            <div class="foto">
                <?php if (!empty($usuario['foto'])): ?>
                    <img src="<?= base_url() ?>uploads/<?= $usuario['foto'] ?>" alt="Foto de perfil">
                <?php else: ?>
                    <span>👤</span>
                <?php endif ?>
            </div>
            
            <form action="<?= base_url('subir-foto') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <label><?= $lang === 'en' ? 'Select image:' : 'Seleccionar imagen:' ?></label>
                <input type="file" name="foto" accept="image/*" required>
                <button type="submit"><?= $lang === 'en' ? 'Upload Photo' : 'Subir Foto' ?></button>
            </form>

            <?php if (!empty($usuario['foto'])): ?>
                <form action="<?= base_url('eliminar-foto') ?>" method="post" onsubmit="return confirm('<?= $lang === 'en' ? 'Delete photo?' : '¿Eliminar la foto?' ?>');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn-rojo"><?= $lang === 'en' ? 'Delete Photo' : 'Eliminar Foto' ?></button>
                </form>
            <?php endif ?>
        </div>

        <div class="volver">
            <a href="<?= base_url('tareas') ?>">← <?= $lang === 'en' ? 'Back to My Tasks' : 'Volver a Mis Tareas' ?></a>
        </div>
    </div>
</body>
</html>