<div class="contenedor login">
    <h1 class="uptask">UpTask</h1>
    <p class="tagline">Crea y Administra tus Proyectos</p>

    <div class="contenedor-sm">
     <p class="descripcion-pagina">Iniciar Sesión</p>
     <form action="/" method="POST" class="formulario">
        <div class="campo">
            <label for="email">Tu Email</label>
            <input type="email" id="email" name="email" placeholder="Tu email" >
        </div>
        <div class="campo">
            <label for="password">Tu Password</label>
            <input type="password" id="password" name="password" placeholder="Tu Password" >
        </div>
        <input type="submit" class="boton" value="Iniciar Sesión">
     </form>
    </div>
    <div class="acciones">
        <a href="/crear">¿Aún sin cuenta? Crea una aqui</a>
        <a href="/olvide">¿Olvidaste tu Password?</a>
    </div>
</div>