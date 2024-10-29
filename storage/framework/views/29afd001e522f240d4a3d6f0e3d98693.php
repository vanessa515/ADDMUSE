<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
   
<h1>Inicio de sesión</h1>

<form action="<?php echo e(route('register.store')); ?>" method="POST">

<?php echo csrf_field(); ?>

   <input type="text" name="user_name" placeholder="Username" required><br>


   <input type="text" name="correo" placeholder="Email" required><br>


   <input type="password" name="contraseña" placeholder="Contraseña" required><br>

   
   <input type="password" name="contraseña_confirmation" placeholder="Confirmacion de contraseña" required><br>

   <a href="login">Iniciar sesión</a><br>

<button type="submit">Guardar</button>
</form>


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


</body>
</html><?php /**PATH C:\xampp\htdocs\addmuse\resources\views/welcome.blade.php ENDPATH**/ ?>