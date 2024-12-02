<?php
// Verificar si ya hay una sesión activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include './db.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../conections/inicio_secion.php');
    exit();
}

// Obtener datos del usuario
$id_usuario = $_SESSION['id_usuario'];

if ($stmt = $conn->prepare("SELECT email FROM usuarios WHERE id_usuario = ?")) {
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
    } else {
        // Redirigir si el usuario no existe en la base de datos
        header('Location: ../conections/inicio_secion.php');
        exit();
    }

    $stmt->close();
} else {
    // Manejo de errores si no se puede preparar la consulta
    die("Error al preparar la consulta.");
}
?>
