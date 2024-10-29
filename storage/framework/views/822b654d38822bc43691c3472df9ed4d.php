<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
</head>
<body>
    
<h1>Albumes</h1>


<form action="<?php echo e(route('album.store')); ?>" method="POST" enctype="multipart/form-data">

<?php echo csrf_field(); ?>

<input type="text" name="nombre_album" placeholder="nombre" required>

<input type="file" name="imagen" placeholder="nombre" required>

<button type="submit" >Enviar</button>

<select name="fk_categoria" id="fk_categoria" class="form-control" required>



        <option value="" disabled selected>Selecciona una opción</option>
        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($categoria->pk_categorias); ?>">
                <?php echo e($categoria->nombre_cat); ?> 
            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select> 

</form>




</body>
</html><?php /**PATH C:\xampp\htdocs\addmuse\resources\views/registroAlbum.blade.php ENDPATH**/ ?>