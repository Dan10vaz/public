<?php

require '../includes/funciones.php';
$auth =  estaAutenticado();

if(!$auth) {
    header('Location: /');
}

//Importar la coneccion 
require '../includes/config/database.php';
$db = conectarDB();

//Escribir el Query
$query = "SELECT * FROM propiedades";

//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);


//Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        //Eliminar el archivo
        $imagenes = "SELECT propiedadId FROM imagenes WHERE propiedadId = ${id}";
        $res = mysqli_query($db, $imagenes);
        $img = mysqli_fetch_assoc($res);
        unlink('../imagenes/' . $img['ruta']);

        //Eliminar la propiedad 
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            header('location: /admin?resultado=3');
        }
    }
}


//Incluye un template

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Panel de Administración</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito">Anuncio Eliminado Correctamente</p>
    <?php endif ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">

        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!--Mostrar los resultados -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <?php 
                    $query = "SELECT * FROM imagenes WHERE propiedadId = $propiedad[id]";
                    //Obtener los reusltados 
                    $resultado_imagenes = mysqli_query($db, $query);?>
                    <?php $imagen = mysqli_fetch_assoc($resultado_imagenes);?>
                    <td><img loading="lazy" height="100" width="100" src="/imagenes/<?php echo $imagen['ruta']; ?>" alt="anuncio"></td>
                    <td>$ <?php echo $propiedad['precio'];  ?></td>
                    <td>
                        <form action="" method="POST" class="w-100">

                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
<?php

//Cerrar la conexion
mysqli_close($db);

incluirTemplate('footer');
?>