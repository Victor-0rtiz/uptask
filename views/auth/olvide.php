<div class="contenedor olvide">
    <?php
    include_once __DIR__ . "/../templates/nombre-sitio.php";

    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu acceso a Uptask</p>
        <?php
    include_once __DIR__ . "/../templates/alertas.php";

    ?>
        <form action="/olvide" method="POST" class="formulario">
            
            <div class="campo">
                <label for="email">Tu Email</label>
                <input type="email" id="email" name="email" placeholder="Tu email">
            </div>
            
            <input type="submit" class="boton" value="Enviar Instrucciones">
        </form>
    </div>
    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/crear">¿No tienes cuenta? Ingresa aqui</a>
    </div>
</div>