<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <title>Página Principal</title>
</head>
<body>

<form action="<?php echo e(route('logout')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <button type="submit">Cerrar sesión</button>
</form>

<!-- Mostrar nombre del usuario -->
<?php if(Auth::check()): ?>
    <h1>Bienvenido, <?php echo e(Auth::user()->user_name); ?>!</h1>
    <hr>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<?php if(session('success')): ?>
    <div><?php echo e(session('success')); ?></div>
<?php endif; ?>

<h1>Música</h1>

<?php $__currentLoopData = $canciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cancion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <strong><?php echo e($cancion->nombre); ?></strong><br>
    <img src="<?php echo e(asset('storage/' . $cancion->imagen)); ?>" alt="Imagen de <?php echo e($cancion->nombre); ?>" style="max-width: 150px;"><br>
    <audio class="audio" src="<?php echo e(asset('storage/' . $cancion->musica)); ?>" controls loop preload="metadata"></audio>
    <p><?php echo e($cancion->duracion); ?></p>
    <p><?php echo e($cancion->fecha); ?></p>
    <hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<a href="registrocat">Registrar categoría</a><br>
<a href="registrocan">Registrar canciones</a><br>
<a href="perfil">Perfil</a>
<a href="registroAlbum">Album</a>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\addmuse\resources\views/home.blade.php ENDPATH**/ ?>