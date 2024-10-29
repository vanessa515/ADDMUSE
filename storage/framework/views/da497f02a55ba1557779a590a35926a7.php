<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro categorias</title>
</head>
<body>

<h1> Registra categorias </h1>
    
<form action="<?php echo e(route('regcat.store')); ?>" method="POST">

<?php echo csrf_field(); ?>


<input type="text" name="nombre" placeholder="Nombre de la categoria" required><br>

<button type="submit"> Guardar </button>

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
</html><?php /**PATH C:\xampp\htdocs\addmuse\resources\views/registroCategoria.blade.php ENDPATH**/ ?>