<?php

    require '../../includes/funciones.php';
    $auth =  estaAutenticado();

    if(!$auth) {
        header('Location: ../index.php');
    }

//Validar la  URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}


// base de datos 
require '../../includes/config/database.php';
$db = conectarDB();

//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//obtener las imagenes
$imagenes = "SELECT * FROM imagenes WHERE propiedadId = $propiedad[id]";
$res = mysqli_query($db, $imagenes);
$img = mysqli_fetch_assoc($res);


//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

    /* echo "<pre>";
    var_dump($_POST);
    echo "</pre>"; */
//Arreglo con mensajes de errores
$errores = [];
    //mantener la informacion cuando el usuario tuvo un error
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedorId'];
    $imagenPropiedad = $img['ruta']; 
    $tipo = $propiedad['tipo'];
    $estatus = $propiedad['estatus'];
//Ejecutar el codigo despues de que el usuario envia el formulario
 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* echo "<pre>";
    var_dump($_POST);
    echo "</pre>"; */

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');
    $tipo = mysqli_real_escape_string($db, $_POST['tipo']);
    $estatus = mysqli_real_escape_string($db, $_POST['estatus']);

    //Asiganar files hacia una variable
    $imagen = $_FILES['imagen'];
    /* echo "<pre>";
    var_dump($_FILES);
    echo "</pre>"; */

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if (!$estacionamiento) {
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }

    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    /* //Validar por tamaño (1 mb maximo)
    $medida = 1000 * 1000;
    if($imagen['size'] > $medida ) {
        $errores[] = "La imagen es muy pesada";
    } */

   /*  echo "<pre>";
    var_dump($errores);
    echo "</pre>"; */

    //Revisar que [] de errores este vacio.
    if (empty($errores)) {

        $nombreImagen = '';
        
        //SUBIDA DE ARCHIVOS 
        $rutas_imagenes = [];
        //SUBIR ARCHIVOS PARA MUCHAS IMAGNEES
        foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES["imagen"]["name"][$key]) {
                //Eliminar la imagen previa
                unlink($carpetaImagenes . $img['ruta']);
                $filename = $_FILES["imagen"]["name"][$key];
                $source = $_FILES["imagen"]["tmp_name"][$key];

                $carpetaImagenes = '../../imagenes/';
                if (!file_exists($carpetaImagenes)) {
                    mkdir($carpetaImagenes);
                }

                $dir = opendir($carpetaImagenes);
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                $target_path = $carpetaImagenes . '/' . $nombreImagen;
                $rutas_imagenes[] = $target_path;

                if (move_uploaded_file($source, $target_path)) {
                    
                } 
                closedir($dir);
            }
        }
            

        //Insertar en la base de datos 
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";
        //Almacenar en la base de datos
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            $propiedad_id = mysqli_insert_id($db);
            for ($i=0; $i - count($rutas_imagenes) ; $i++) { 
                $query_insert_image = "INSERT INTO imagenes (propiedadId, ruta) VALUES ('$propiedad_id', '$rutas_imagenes[$i]')";
                mysqli_query($db, $query_insert_image);
            }
            // Redireccionar al usuario 
            header('Location: /admin?resultado=2');
        }
    }
}





incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Inmuebles</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="estatus">Estatus:</label>
            <select name="estatus" id="estatus">
            <option value="">-- Seleccione --</option>
            <option value="venta">Venta</option>
            <option value="renta">Renta</option>
            </select>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
            <option value="">-- Seleccione --</option>
            <option value="casa">Casa</option>
            <option value="departamento">Departamento</option>
            <option value="bodega">Bodega</option>
            </select>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio?>">

            <!-- <label for="imagen">Imagenes:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" name="imagen" multiple="multiple"> -->

            <div class="div_centrado">
                <label for="imagen">Imagenes:</label>
                <input type="file" id="imagen" name="imagen[]" accept="image/jpeg, image/png" multiple="">
                <br clear="all"><br clear="all">
                <output id="miniaturas"></output>
            </div>

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="0" max="9" value="<?php echo $habitaciones?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="0" max="9" value="<?php echo $wc?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="0" max="9" value="<?php echo $estacionamiento?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>