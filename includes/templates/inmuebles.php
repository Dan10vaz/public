
<?php 
    //Importar la base de datos 
    require __DIR__ . '/../config/database.php';
   
  
    $db = conectarDB();

    //Consultar 
    $query = "SELECT * FROM propiedades WHERE estatus='${estatus}' AND tipo='${tipo}' LIMIT ${limite}";
    
    //Obtener los reusltados 
    $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-cards">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
        <div class="card">
            <picture>
        <?php 
        $query = "SELECT * FROM imagenes WHERE propiedadId = $propiedad[id]";
            //Obtener los reusltados 
            $resultado_imagenes = mysqli_query($db, $query);?>
            <?php $imagen = mysqli_fetch_assoc($resultado_imagenes);?>
            <img loading="lazy" height="300" width="300" src="/imagenes/<?php echo $imagen['ruta']; ?>" alt="anuncio">
            </picture>
    
        <div class="contenido-card">
            <h3> <strong> <?php echo $propiedad['titulo']; ?> </strong></h3>
            <?php $string_bd = $propiedad['descripcion']; ?>
            <?php if(strlen($string_bd) > 150) {
                   $description = substr($string_bd, 0, 150) . "...";
                }
            ?>
            <p><?php echo $description; ?></p>
            <p class="precio">$ <?php echo $propiedad['precio']; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>

                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class=" boton-amarillo-block">
                Ver Propiedad
            </a>
        </div>
        <!--contenido-card-->
    </div>
    <!--card-->
    <?php endwhile; ?>
</div>
<!--Contenedor-cards-->

<?php 

    //Cerrar la conexion 
    mysqli_close($db);
?>