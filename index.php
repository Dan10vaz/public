<?php
require 'includes/funciones.php';
incluirTemplate('header', $inicio = true);
?>

<main class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Ahora que estás buscando <B>comprar casa o departamento</B>, es importante que cuides tu patrimonio realizando una compra de forma <B>segura</B> . Comprar casa además de ser una de las <B>decisiones más importantes en la vida</B> de cada persona, también es un proceso que puede generar estrés y un sin fin de dudas. Esto lo puedes evitar siguiendo las medidas que <B>nosotros</B> te proporcionamos para comprar fácil y seguro.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Ahora que estás buscando <B>comprar casa o departamento</B>, es importante que cuides tu patrimonio realizando una compra de forma <B>segura</B> . Comprar casa además de ser una de las <B>decisiones más importantes en la vida</B> de cada persona, también es un proceso que puede generar estrés y un sin fin de dudas. Esto lo puedes evitar siguiendo las medidas que <B>nosotros</B> te proporcionamos para comprar fácil y seguro.</p>
        </div>

        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Ahora que estás buscando <B>comprar casa o departamento</B>, es importante que cuides tu patrimonio realizando una compra de forma <B>segura</B> . Comprar casa además de ser una de las <B>decisiones más importantes en la vida</B> de cada persona, también es un proceso que puede generar estrés y un sin fin de dudas. Esto lo puedes evitar siguiendo las medidas que <B>nosotros</B> te proporcionamos para comprar fácil y seguro.</p>
        </div>
    </div>
</main>

<section class="seccion contenedor">
    <h2><strong>Inmuebles en venta</strong></h2>
    
    <?php 
        $estatus = isset($_GET['estatus'])? $_GET['estatus']:'venta';
        $tipo = isset($_GET['tipo'])? $_GET['tipo']:'casa';
        $limite = 3;
        include 'includes/templates/inmuebles.php';
    ?>

    <div class="alinear-derecha">
        <a href="inmuebles.php" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagenes-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p style="text-align: center;">Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="contacto.php" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>13/12/2021</span> por: <span>Admin</span></p>
                    <P>
                        Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                    </P>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>13/12/2021</span> por: <span>Admin</span></p>
                    <P>
                        Maximiza el espacio de tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                    </P>
                </a>
            </div>
        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comporto de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas
            </blockquote>
            <p>- Daniel Vázquez</p>
        </div>
    </section>
</div>

<?php
incluirTemplate('footer');
?>