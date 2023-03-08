<div class="contenedor crear">
    <?php
    include_once __DIR__ . "/../templates/nombre-sitio.php";

    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en uptask</p>
        <?php 
        include_once __DIR__."/../templates/alertas.php"
        ?>
        <form action="/crear" method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Tu Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $usuario->nombre; ?>">
            </div>
            <div class="campo">
                <label for="email">Tu Email</label>
                <input type="email" id="email" name="email" placeholder="Tu email" value="<?php echo $usuario->email; ?>">
            </div>
            <div class="campo">
                <label for="password">Tu Password</label>
                <input type="password" id="password" name="password" placeholder="Tu Password">
            </div>
            <div class="campo">
                <label for="password2">Repite tu Password</label>
                <input type="password" id="password2" name="password2" placeholder="Repite tu Password">
            </div>
            <input type="submit" class="boton" value="Crear Cuenta">
        </form>
    </div>
    <div class="acciones">
        <a href="/">¿Ya tienes cuenta? Ingresa aqui</a>
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</div>