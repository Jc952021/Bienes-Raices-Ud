<?php  
require "./includes/funciones.php";
traerInclude("header")
?>
<div class="contacto contenedor">
<h2>Contacto</h2>
<picture>
  <img src="build/img/destacada3.jpg" alt="">
</picture>
<h2>Llene el formulario de Contacto</h2>
<form class="formulario">
  <fieldset>
    <legend>Información Personal</legend>
    <label for="nombre">Nombre</label>
    <input type="text" placeholder="Tu Nombre" id="nombre">
    <label for="email">E-mail</label>
    <input type="email" placeholder="Tu E-mail" id="email">
    <label for="telefono">Teléfono</label>
    <input type="tel" placeholder="Tu Teléfono" id="telefono">
    <label for="telefono">Mensaje</label>
    <textarea name="" id="" cols="30" rows="10"></textarea>
  </fieldset>

  <fieldset>
    <legend>Información sobre la propiedad</legend>
    <label for="vende">Vende o Compra:</label>
    <select name="" id="vende">
      <option value="" disabled>--Seleccione</option>
      <option value="compra">Compra</option>
      <option value="vende">Vende</option>
    </select>
    <label for="precio">Precio o Presupuesto</label>
    <input type="number" placeholder="Tu Precio o Presupuesto" id="precio">
  </fieldset>

  <fieldset>
    <legend>Información sobre la propiedad</legend>

    <p>Como desea ser contactado</p>
    <div class="radios">
      <label for="">Teléfono</label>
      <input type="radio" name="radio">

      <label for="">E-mail</label>
      <input type="radio" name="radio">
    </div>
    <p>Si eligió teléfono, elija la fecha y la hora</p>
    <label for="precio">Fecha:</label>
    <input type="date">

    <label for="precio">Hora:</label>
    <input type="time" min="9:00">
  </fieldset>

  <button type="submit" class="boton-verde">Enviar</button>
</form>
</div>


<?php
traerInclude("footer")
?>