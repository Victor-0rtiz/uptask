<?php include_once __DIR__ . "/headerDashboard.php"; ?>

<?php if (count($proyectos) == 0) { ?>
    <p class="no-proyectos">No hay proyectos, <a href="/crear-proyecto">comienza creando uno aqui</a></p>
<?php  } else { ?>
    <ul class="listado-proyectos">
        <?php foreach ($proyectos as $proyecto) { ?>
            <li class="proyecto">
                <a href="/proyecto?id=<?php echo $proyecto->url ?>"> <?php echo $proyecto->proyecto ?></a>
            </li>
        <?php } ?>
    </ul>
<?php } ?>
<?php include_once __DIR__ . "/footerDashboard.php"; ?>