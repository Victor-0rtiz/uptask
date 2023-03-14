<?php include_once __DIR__ . "/headerDashboard.php"; ?>

<div class="contenedor-sm">
    <div class="contenedor-nueva-tarea">
        <button type="button" class="agregar-tarea" id="agregar-tarea">&#43; Nueva Tarea</button>
    </div>
    <ul class="listado-tareas"></ul>
</div>
<?php include_once __DIR__ . "/footerDashboard.php"; ?>
<?php
$script = "<script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
<script src='/build/js/tareas.js'></script>";
?>