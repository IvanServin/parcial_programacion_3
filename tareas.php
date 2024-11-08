<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $archivoAdjunto = $_FILES['archivo']['name'];

    $rutaArchivo = 'uploads/' . $archivoAdjunto;
    move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo);

    $query = "INSERT INTO tareas (nombre, archivo_adjunto) VALUES (:nombre, :archivoAdjunto)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':archivoAdjunto', $rutaArchivo);

    if ($stmt->execute()) {
        echo "<div class='message'>Tarea creada exitosamente!</div>";
    } else {
        echo "<div class='message'>Error al crear la tarea.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    <link rel="stylesheet" href="estilos.css">
    <script>
        // Función para confirmar la eliminación
        function confirmDelete(id) {
            if (confirm('¿Estás seguro de eliminar esta tarea?')) {
                window.location.href = "tareas.php?id=" + id + "&eliminar=true";
            }
        }

        // Función para marcar como completada
        function completarTarea(id) {
            if (confirm('¿Estás seguro de completar esta tarea?')) {
                window.location.href = "tareas.php?id=" + id + "&completar=true";
            }
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Crear Nueva Tarea</h2>
    <form action="tareas.php" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre de la tarea:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="archivo">Archivo adjunto (opcional):</label>
        <input type="file" name="archivo" id="archivo">

        <button type="submit">Crear tarea</button>
    </form>
</div>

<div class="container">
    <h2>Tareas Pendientes</h2>
    <ul>
        <?php
        $query_pendientes = "SELECT * FROM tareas WHERE completada = FALSE AND eliminada = FALSE ORDER BY fecha_creacion DESC";
        $stmt_pendientes = $pdo->query($query_pendientes);
        $tareas_pendientes = $stmt_pendientes->fetchAll(PDO::FETCH_ASSOC);

        if (empty($tareas_pendientes)) {
            echo "<li class='no-tareas'>No hay tareas pendientes.</li>";
        }

        foreach ($tareas_pendientes as $tarea): ?>
            <li>
                <strong><?php echo htmlspecialchars($tarea['nombre']); ?></strong><br>
                <small>Fecha de creación: <?php echo $tarea['fecha_creacion']; ?></small><br>
                <?php if ($tarea['archivo_adjunto']): ?>
                    <a class="ver-pdf" href="<?php echo $tarea['archivo_adjunto']; ?>" target="_blank">Ver PDF</a><br>
                <?php endif; ?>
                <a class="completar" href="javascript:void(0);" onclick="completarTarea(<?php echo $tarea['id']; ?>)">Completar</a>
                <a class="eliminar" href="javascript:void(0);" onclick="confirmDelete(<?php echo $tarea['id']; ?>)">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<div class="container">
    <h2>Tareas Completadas</h2>
    <ul>
        <?php
        $query_completadas = "SELECT * FROM tareas WHERE completada = TRUE AND eliminada = FALSE ORDER BY fecha_completada DESC";
        $stmt_completadas = $pdo->query($query_completadas);
        $tareas_completadas = $stmt_completadas->fetchAll(PDO::FETCH_ASSOC);

        if (empty($tareas_completadas)) {
            echo "<li class='no-tareas'>No hay tareas completadas.</li>";
        }

        foreach ($tareas_completadas as $tarea): ?>
            <li>
                <strong><?php echo htmlspecialchars($tarea['nombre']); ?></strong><br>
                <small>Fecha de completado: <?php echo $tarea['fecha_completada']; ?></small><br>
                <?php if ($tarea['archivo_adjunto']): ?>
                    <a class="ver-pdf" href="<?php echo $tarea['archivo_adjunto']; ?>" target="_blank">Ver PDF</a><br>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
