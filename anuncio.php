<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('location: /');
}

//Importar la conexion
require 'includes/config/database.php';
$db = conectarDB();
//Consultar la base de datos
$query = "SELECT * FROM propiedades WHERE id = ${id}";

/* $query = "SELECT * FROM imagenes WHERE propiedadId = $propiedad[id]"; */
//Obtener el resultado
$resultado = mysqli_query($db, $query);

if (!$resultado->num_rows) {
    header('location: /');
}

$propiedad = mysqli_fetch_assoc($resultado);

require 'includes/funciones.php';
incluirTemplate('header');
?>
 
<main class="contenedor seccion contenido-centrado">
    <h1><strong><?php echo $propiedad['titulo']; ?></strong></h1>
    
    <?php
    $imagenes = "SELECT * FROM imagenes WHERE propiedadId = $propiedad[id]";
    $res = mysqli_query($db, $imagenes);
    ?>

    <div class="container-slider">
        <div class="slider" id="slider">
            <?php while ($img = mysqli_fetch_assoc($res)) : ?>
            <div class="slider__section"><img loading="lazy" src="/imagenes/<?php echo $img['ruta']; ?>" alt="imagen"></div>
            <?php endwhile; ?> 
        </div>
        <div class="slider__btn slider__btn--right">&#60</div>
        <div class="slider__btn slider__btn--left">&#62</div>
    </div>
    

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad['precio']; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p> <?php echo $propiedad['wc']; ?></p>
            </li>

            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p> <?php echo $propiedad['estacionamiento']; ?></p>
            </li>

            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']; ?></p>
    </div>
</main>

<?php

mysqli_close($db);

incluirTemplate('footer');
?>