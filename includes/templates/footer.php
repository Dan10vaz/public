<footer class="footer seccion">
    <div class="contenedor contenedor-footer">
        <nav class="navegacion">
            <a href="nosotros.php">Nosotros</a>
            <a href="anuncios.php">Anuncios</a>
            <a href="blog.php">Blog</a>
            <a href="contacto.php">Contacto</a>
            <a href="https://www.facebook.com/Toluca-Grupo-Inmobiliario-102254578535558/"><img src="/build/img/facebook_logo.png" class="facebook" alt="Facebook"></a>
        </nav>
    </div>

    <p class="copyright">Todos los derechos Reservados <?php echo date('Y'); ?> &copy;</p>
</footer>



<script src="/build/js/bundle.min.js"></script>
<!-- <script src="/jQuery-3.6.0.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    
    function handleFileSelect(evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
          if (!f.type.match('image.*')) {
            continue;
          }
    
          var reader = new FileReader();
          reader.onload = (function(theFile) {
            return function(e) {
              var span = document.createElement('span');
              span.innerHTML = ['<img class="img_galeria" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
              document.getElementById('miniaturas').insertBefore(span, null);
            };
          })(f);
          reader.readAsDataURL(f);
        }
      }
        document.getElementById('imagen').addEventListener('change', handleFileSelect, false);
</script>
</body>
</html>