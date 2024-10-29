<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

<h1>Perfil</h1><br>

<?php if($usuarios->isNotEmpty()): ?>

    <?php
        $nombreActual = null; // Variable de control para mostrar nombre y correo solo una vez
    ?>


    <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($nombreActual !== $usuario->Nombre_usuario): ?>
            <?php
                $nombreActual = $usuario->Nombre_usuario;
            ?>
          
            <h2>Nombre de Usuario:</h2>
            <p><?php echo e($usuario->Nombre_usuario); ?></p><br>
            <h2>Correo Electrónico: </h2>
            <p><?php echo e($usuario->Correo_electronico); ?></p>

          
                  
                
        <h1>Musicas</h1>  
        <?php endif; ?>
   
        <img src="<?php echo e(asset('storage/' . $usuario->imagen)); ?>"  style="max-width: 150px;"><br>
            <h2><?php echo e($usuario->Musica); ?></h2>
         
            <h2><?php echo e($usuario->fecha); ?></h2>
            <audio class="audio" src="<?php echo e(asset('storage/' . $usuario->musica)); ?>"  controls looppreload="metadata"></audio> <br>
      

        <?php if($loop->last || $nombreActual !== $usuarios[$loop->index + 1]->Nombre_usuario): ?>
             
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <p>No hay información disponible.</p>
<?php endif; ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\addmuse\resources\views/perfil.blade.php ENDPATH**/ ?>