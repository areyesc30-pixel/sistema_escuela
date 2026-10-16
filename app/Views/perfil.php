<!DOCTYPE html>
<html lang="<?= session()->get('idioma_actual') ?? 'es' ?>">
<head>
    <meta charset="UTF-8">
    <title><?= (session()->get('idioma_actual') ?? 'es') === 'en' ? 'My Profile' : 'Mi Perfil' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f0f4f8; padding: 20px; }
        .cabecera { display: flex; align-items: center; justify-content: space-between; background: #ffffff; padding: 15px 25px; border-radius: 12px; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
        .idiomas a { margin: 0 5px; text-decoration: none; font-weight: bold; }
        .activo { color: #2b6cb0; border-bottom: 2px solid #2b6cb0; }
        .inactivo { color: #718096; }
        .contenedor { max-width: 550px; margin: 0 auto; }
        .caja { background: white; padding: 25px; border-radius: 12px; margin-bottom: 20px; }
        .caja h3 { color: #2b6cb0; margin-bottom: 18px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        .foto-seccion { text-align: center; margin-bottom: 20px; }
        .foto-perfil-grande { width: 130px; height: 130px; border-radius: 50%; overflow: hidden; border: 3px solid #2b6cb0; margin: 0 auto 15px; }
        .foto-perfil-grande img { width: 100%; height: 100%; object-fit: cover; }
        .sin-foto { width: 100%; height: 100%; background: #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 45px; }
        .dato { padding: 10px 0; border-bottom: 1px solid #e2e8f0; }
        .etiqueta { font-weight: bold; color: #4a5568; display: inline-block; min-width: 140px; }
        .valor { color: #2d3748; }
        .mensaje { padding: 14px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid; }
        .exito { background: #f0fff4; color: #22543d; border-color: #38a169; }
        .error { background: #fff5f5; color: #c53030; border-color: #e53e3e; }
        label { display: block; margin: 14px 0 6px; font-weight: bold; color: #4a5568; }
        input { width: 100%; padding: 11px; border: 2px solid #e2e8f0; border-radius: 8px; font-size: 15px; }
        button { padding: 11px 22px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 15px; margin-top: 10px; }
        .btn-azul { background: #2b6cb0; color: white; width: 100%; }
        .btn-verde { background: #38a169; color: white; width: 100%; }
        .btn-rojo { background: #e53e3e; color: white; }
        .btn-archivo { margin-top: 10px; }
        .volver { display: block; text-align: center; margin-top: 20px; color: #2b6cb0; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
<?php $idioma = session()->get('idioma_actual') ?? 'es'; ?>

<div class="cabecera">
    <div class="idiomas">
        <a href="<?= base_url('cambiar-idioma/es') ?>" class="<?= $idioma==='es'?'activo':'inactivo' ?>">ES</a> |
        <a href="<?= base_url('cambiar-idioma/en') ?>" class="<?= $idioma==='en'?'activo':'inactivo' ?>">EN</a>
    </div>
    <div></div>
</div>

<div class="contenedor">
    <?php if (session()->getFlashdata('exito')): ?>
        <div class="mensaje exito"><?= session()->getFlashdata('exito') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="mensaje error"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- FOTO DE PERFIL -->
    <div class="caja">
        <h3><?= $idioma==='en'?'Profile Photo':'Foto de Perfil' ?></h3>
        <div class="foto-seccion">
            <div class="foto-perfil-grande">
                <?php if (!empty($usuario['foto'])): ?>
                    <img src="<?= base_url('uploads/'.$usuario['foto']) ?>" alt="Foto de perfil">
                <?php else: ?>
                    <div class="sin-foto">👤</div>
                <?php endif; ?>
            </div>
            
            <!-- FORMULARIO SUBIR FOTO -->
            <form action="<?= base_url('subir-foto') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <label class="btn-archivo"><?= $idioma==='en'?'Select image:':'Seleccionar imagen:' ?></label>
                <input type="file" name="foto" accept="image/*" required>
                <button type="submit" class="btn-verde"><?= $idioma==='en'?'Upload Photo':'Subir Foto' ?></button>
            </form>
            
            <!-- ELIMINAR FOTO -->
            <?php if (!empty($usuario['foto'])): ?>
                <form action="<?= base_url('eliminar-foto') ?>" method="post" onsubmit="return confirm('<?= $idioma==='en'?'Delete this photo?':'¿Eliminar esta foto?' ?>');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn-rojo"><?= $idioma==='en'?'Remove Photo':'Eliminar Foto' ?></button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- DATOS DEL USUARIO -->
    <div class="caja">
        <h3><?= $idioma==='en'?'Account Information':'Datos de la Cuenta' ?></h3>
        
        <a href="<?= base_url('editar-usuario') ?>" style="display:inline-block; background:#2b6cb0; color:white; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:bold; margin-bottom:15px;">
            <?= $idioma==='en'?'Edit Information':'Editar Información' ?>
        </a>
        
        <div class="dato">
            <span class="etiqueta"><?= $idioma==='en'?'Full Name:':'Nombre Completo:' ?></span>
            <span class="valor"><?= esc($usuario['nombre']) ?></span>
        </div>
        <div class="dato">
            <span class="etiqueta"><?= $idioma==='en'?'Email:':'Correo Electrónico:' ?></span>
            <span class="valor"><?= esc($usuario['correo']) ?></span>
        </div>
        <div class="dato">
            <span class="etiqueta"><?= $idioma==='en'?'Status:':'Estado:' ?></span>
            <span class="valor"><?= $usuario['activo'] ? ($idioma==='en'?'Active':'Activa') : ($idioma==='en'?'Inactive':'Inactiva') ?></span>
        </div>
        <?php if (!empty($usuario['created_at'])): ?>
        <div class="dato">
            <span class="etiqueta"><?= $idioma==='en'?'Created:':'Fecha de Creación:' ?></span>
            <span class="valor"><?= date('d/m/Y H:i', strtotime($usuario['created_at'])) ?></span>
        </div>
        <?php endif; ?>
        <?php if (!empty($usuario['updated_at'])): ?>
        <div class="dato">
            <span class="etiqueta"><?= $idioma==='en'?'Last Updated:':'Última Modificación:' ?></span>
            <span class="valor"><?= date('d/m/Y H:i', strtotime($usuario['updated_at'])) ?></span>
        </div>
        <?php endif; ?>
    </div>

    <!-- CAMBIAR CONTRASEÑA -->
    <div class="caja">
        <h3><?= $idioma==='en'?'Change Password':'Cambiar Contraseña' ?></h3>
        <form action="<?= base_url('cambiar-contrasena') ?>" method="post">
            <?= csrf_field() ?>
            <label><?= $idioma==='en'?'Current Password:':'Contraseña Actual:' ?></label>
            <input type="password" name="contrasena_actual" required>
            
            <label><?= $idioma==='en'?'New Password:':'Contraseña Nueva:' ?></label>
            <input type="password" name="contrasena_nueva" required>
            
            <label><?= $idioma==='en'?'Confirm New Password:':'Confirmar Contraseña:' ?></label>
            <input type="password" name="confirmar_nueva" required>
            
            <button type="submit" class="btn-verde"><?= $idioma==='en'?'Update Password':'Actualizar Contraseña' ?></button>
        </form>
    </div>

    <a href="<?= base_url('tareas') ?>" class="volver">← <?= $idioma==='en'?'Back to My Tasks':'Volver a Mis Tareas' ?></a>
</div>

</body>
</html>