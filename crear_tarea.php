<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $archivoAdjunto = $_FILES['archivo']['name'];
    
    $rutaArchivo = 'uploads/' . $archivoAdjunto;
    move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaArchivo);


    $query = "INSERT INTO tareas (nombre, archivo_adjunto) VALUES (:nombre, :archivoAdjunto)";
    
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':archivoAdjunto', $rutaArchivo);

    if ($stmt->execute()) {
        echo "Tarea creada exitosamente!";
        header("location: tareas.php");
        exit();
        
    } else {
        echo "Error al crear la tarea.";
    }
}
?>