<div class="contenedor reestablecer">
    <?php
    include_once __DIR__ . "/../templates/nombre-sitio.php";

    ?>

    <div class="contenedor-sm">
    <?php
    include_once __DIR__ . "/../templates/alertas.php";

    ?>
        <?php if($mostrar){ ?>
        <p class="descripcion-pagina">Coloca tu nuevo password</p>
        
        <form action="/reestablecer" method="POST" class="formulario">
            
            <div class="campo">
                <label for="password">Tu Nuevo Password</label>
                <input type="password" id="password" name="password" placeholder="Tu nuevo password">
            </div>
            
            <input type="submit" class="boton" value="Guardar Nuevo Password">
        </form>
        <?php }?>
    </div>
    <div class="acciones">
        <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/crear">¿No tienes cuenta? Ingresa aqui</a>
    </div>
</div>