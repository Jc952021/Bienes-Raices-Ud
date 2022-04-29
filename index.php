<?php  

require "./includes/funciones.php";
traerInclude("header",true)
?>
  
      <main class="nosotros contenedor">
        <h1>Más Sobre Nosotros</h1>
        <div class="iconos__contenedor ">
          <div class="icono">
            <img src="build/img/icono1.svg" alt="">
            <h3>Seguridad</h3>
            <p>Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit minus consectetur obcaecati molestiae dolorem natus dolores reiciendis tempore, explicabo cum nobis laudantium. Voluptates?</p>
          </div>
          <div class="icono">
            <img src="build/img/icono2.svg" alt="">
            <h3>Precio</h3>
            <p>Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit minus consectetur obcaecati molestiae dolorem natus dolores reiciendis tempore, explicabo cum nobis laudantium. Voluptates?</p>
          </div>
          <div class="icono">
            <img src="build/img/icono3.svg" alt="">
            <h3>A tiempo</h3>
            <p>Possimus, suscipit repudiandae. Autem deserunt aliquid deleniti sit minus consectetur obcaecati molestiae dolorem natus dolores reiciendis tempore, explicabo cum nobis laudantium. Voluptates?</p>
          </div>
        </div>
      </main>

      <div class="anuncios contenedor">
        <h2>Casas y Depas en Venta</h2>
        <!-- mostrar aqui el template anuncios -->
        <?php
        $limite = 3;
        include "./includes/templates/anuncios.php";
        ?>
            <div class="alinear-derecha">
              <a href="" class="boton-verde">Ver Todas</a>
            </div>
        </div>

        <div class="contacto-imagen">
          <h2>Encuentra la casa de tus sueños</h2>
          <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
          <a href="" class="boton-amarillo">Contáctanos</a>
        </div>
  
  <div class="testimoniales contenedor">
    <section class="blog">
      <h2>Nuestro Blog</h2>
      <article class="entrada-blog">
        <picture>
          <img src="./build/img/blog1.jpg" alt="">
        </picture>
        <div class="entrada-texto">
          <a href="">
            <h4>Terraza en el techo de tu casa</h4>
            <p class="texto-meta">Escrito el :<span>20/10/2021</span> por:<span>Admin</span></p>
            <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
          </a>
        </div>
      </article>

      <article class="entrada-blog">
        <picture>
          <img src="./build/img/blog2.jpg" alt="">
        </picture>
        <div class="entrada-texto">
          <a href="">
            <h4>Guía para la decoración de tu hogar</h4>
            <p class="texto-meta">Escrito el :<span>20/10/2021</span> por:<span>Admin</span></p>
            <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
          </a>
        </div>
      </article>
    </section>
    <section class="testimonio">
      <h2>Testimoniales</h2>
      <div class="testimonio-contenedor">
        <blockquote>
          El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
        </blockquote>
        <p>Siuuuuuuuuu</p>
      </div>
    </section>
  </div>

  <?php
traerInclude("footer")
?>