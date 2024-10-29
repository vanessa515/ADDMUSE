<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
   
<h1>Login</h1>

<form action="<?php echo e(route('login.post')); ?>" method="POST">

<?php echo csrf_field(); ?>

<input type="text" name="user_name" placeholder="Username" required><br>

<input type="password" name="contraseña" placeholder="Contraseña" required><br>

<button type="submit">Iniciar sesión</button>
<a href="/">Registrate!!</a>

</form>

<!-- Mostrar errores de validación -->
<?php if($errors->any()): ?>
    <div>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Mostrar mensaje de éxito si existe -->
<?php if(session('success')): ?>
    <div><?php echo e(session('success')); ?></div>
<?php endif; ?>


</body>
</html><?php /**PATH C:\xampp\htdocs\addmuse\resources\views/login.blade.php ENDPATH**/ ?>