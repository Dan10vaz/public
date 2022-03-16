<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Guia para la decoración de tu hogar</h1>
        

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.webp" alt="imagen de la propiedad">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

        <div class="resumen-propiedad">

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia illum rem quia, deleniti ratione atque temporibus magni nemo quis perferendis dolorem mollitia ipsa quam voluptatem fugiat eos voluptas amet earum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla ex eaque aut dolor, error laboriosam! Error consequuntur libero, veniam aut tempore exercitationem animi doloremque est! Accusamus, iste sunt. Nobis, porro? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quia eius vel, eveniet cum quidem distinctio inventore adipisci aperiam corrupti dolore nobis facere placeat nemo veritatis. Nostrum mollitia repellendus ipsam quod?</p>
        </div>
    </main>

    <?php 
        incluirTemplate('footer');
    ?>

