<?php include_once __DIR__."/headerDashboard.php"; ?>

<div class="contenedor-sm">
    <?php include_once __DIR__."/../templates/alertas.php";  ?>
    <a href="/perfil" class="enlace">Volver al perfil</a>
    <form action="/cambiar-password" class="formulario" method="POST">
        <div class="campo">
            <label for="password_actual">Tu password anterior</label>
            <input type="password"  name="password_actual" placeholder="Tu password anterior">
        </div>
        <div class="campo">
            <label for="password_nuevo">Tu nuevo password</label>
            <input type="password"  name="password_nuevo" placeholder="Tu password nuevo">
        </div>
        <input type="submit" value="Guardar Cambios">
    </form>
</div>
<?php include_once __DIR__."/footerDashboard.php"; ?>