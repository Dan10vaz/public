<?php 
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jgp" type="image/jgp">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    Valores
                </blockquote>

                <ul>
                    <li>
                        Honestidad 
                        <p>
                        INNOVACION e IMAGINACION son los valores centrales que guían a nuestra organización.
                        </p>
                    </li>
                </ul>
            </div>
        </div>
    </main>



    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, pariatur! Error, quas eligendi magnam similique sapiente suscipit doloremque dignissimos repudiandae hic necessitatibus vitae nihil eius minima iure provident aliquam beatae.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, pariatur! Error, quas eligendi magnam similique sapiente suscipit doloremque dignissimos repudiandae hic necessitatibus vitae nihil eius minima iure provident aliquam beatae.</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, pariatur! Error, quas eligendi magnam similique sapiente suscipit doloremque dignissimos repudiandae hic necessitatibus vitae nihil eius minima iure provident aliquam beatae.</p>
            </div>
        </div>
    </section>

    <?php 
        incluirTemplate('footer');
    ?>
