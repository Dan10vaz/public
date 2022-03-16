<?php
    require 'includes/funciones.php';
    incluirTemplate('header');

    $estatus = isset($_GET['estatus'])? $_GET['estatus']:'venta';
    $tipo = isset($_GET['tipo'])? $_GET['tipo']:'casa';
    
?>

<main class="contenedor seccion">


<h2><strong><?php 


if($estatus == 'venta') {
    echo 'En venta' ;
} else {
echo 'En renta';
}

?>
</strong></h2>
    <a href="<?php echo '/inmuebles.php?estatus='.$estatus.'&tipo=casa'?>" class="boton-amarillo">Casas</a>
    <a href="<?php echo '/inmuebles.php?estatus='.$estatus.'&tipo=departamento'?>" class="boton-amarillo">Depas</a>
    <a href="<?php echo '/inmuebles.php?estatus='.$estatus.'&tipo=bodega'?>" class="boton-amarillo">Bodegas</a>
    <br>
    <br>
    <?php
        $limite = 15;
        include 'includes/templates/inmuebles.php';
    ?>

</main>

<?php
    incluirTemplate('footer');
?>