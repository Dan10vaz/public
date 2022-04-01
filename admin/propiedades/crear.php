<?php

// base de datos 

require '../../includes/config/database.php';
$db = conectarDB();

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = [];
//mantener la informacion cuando el usuario tuvo un error
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$tipo = '';
$estatus = '';


//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    if (!$estatus) {
        $errores[] = "Debes añadir un estatus del inmueble";
    }

    if (!$tipo) {
        $errores[] = "Debes añadir un tipo de inmueble";
    }

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }

    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }

    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }

    if ($habitaciones <= -1) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }

    if ($wc <= -1) {
        $errores[] = "El numero de baños es obligatorio";
    }

    if ($estacionamiento <= -1) {
        $errores[] = "El numero de lugares de estacionamiento es obligatorio";
    }

    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }

    if(!$imagen['name']){
        $errores[] = "Las imagenes son obligatorias";
    }

    //Validar por tamaño (1 mb maximo)
    $medida = 100000 * 100000;

    if(!$imagen['size'] > $medida ) {
        $errores[] = "Las imagenes son muy pesadas";
    }

    /* echo "<pre>";
    var_dump($errores);
    echo "</pre>"; */

    //Revisar que [] de errores este vacio.
    if (empty($errores)) {

        //SUBIDA DE ARCHIVOS para una sola imagen
        //Crear una carpeta
        /* $carpetaImagenes = '../../imagenes/';
        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        } */
        $rutas_imagenes = [];
        //SUBIR ARCHIVOS PARA MUCHAS IMAGNEES
        foreach ($_FILES['imagen']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES["imagen"]["name"][$key]) {
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

        /* //Generar un nombre unico para una sola imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        //Subir la imagen // IMAGENES*******
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen); */

       /*  echo "<pre>";
        var_dump($imagen);
        echo "</pre>"; */

      /*   exit; */
        //Insertar en la base de datos 
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId, tipo, estatus) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId', '$tipo', '$estatus')";
        //Almacenar en la base de datos
        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            $propiedad_id = mysqli_insert_id($db);
            for ($i=0; $i - count($rutas_imagenes) ; $i++) { 
                $query_insert_image = "INSERT INTO imagenes (propiedadId, ruta) VALUES ('$propiedad_id', '$rutas_imagenes[$i]')";
                mysqli_query($db, $query_insert_image);
            }
            // Redireccionar al usuario 
            header('Location: /admin?resultado=1');
        }
    }
}

require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Alta de Inmuebles</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="estatus">Estatus:</label>
                <select name="estatus" id="estatus">
                    <option value="">-- Seleccione --</option>
                    <option value="venta" <?php if($estatus== "venta"){echo "selected='selected'";}?>>Venta</option>
                    <option value="renta" <?php if($estatus== "renta"){echo "selected='selected'";}?>>Renta</option>
                 </select>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
            <option value="">-- Seleccione --</option>
            <option value="casa" <?php if($tipo== "casa"){echo "selected='selected'";}?>>Casa</option>
            <option value="departamento" <?php if($tipo== "departamento"){echo "selected='selected'";}?>>Departamento</option>
            <option value="bodega" <?php if($tipo== "bodega"){echo "selected='selected'";}?>>Bodega</option>
            <option value="terreno" <?php if($tipo== "terreno"){echo "selected='selected'";}?>>Terreno</option>
            </select>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio ?>">

            <div class="div_centrado">
                <label for="imagen">Imagenes:</label>
                <input type="file" id="imagen" name="imagen[]" accept="image/jpeg, image/png" multiple="">
                <br clear="all"><br clear="all">
                <output id="miniaturas"></output>
            </div>
            <br clear="all"><br clear="all">
            
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="0" max="15" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="0" max="15" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="0" max="15" value="<?php echo $estacionamiento ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
incluirTemplate('footer');
?>