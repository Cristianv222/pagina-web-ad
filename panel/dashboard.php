<?php
session_start();
include './db.php';

// Verifica si la sesión está activa
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Consulta para obtener el email del usuario
$result = $conn->query("SELECT email FROM usuarios WHERE id_usuario = $id_usuario");

if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc(); // Asigna el usuario
} else {
    $usuario = null; // Maneja el caso en que no haya resultados
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="./dashboard.css">
</head>
<body>
    <!-- Contenedor Principal -->
    <div class="container">
        <!-- Topbar -->
        <div class="topbar">
            <div class="logo">
                <a href="../index.php"><img src="logo.png" alt="Logo" class="logo-img"></a>
            </div>
            <div class="user-info">
                <?php if ($usuario): ?>
                    <span class="user-email"><?php echo htmlspecialchars($usuario['email']); ?></span>
                <?php else: ?>
                    <span class="user-error">Error: Usuario no encontrado.</span>
                <?php endif; ?>
                <a href="../conections/logout.php" class="logout-btn">Cerrar sesión</a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <ul>
                <li><a href="./upload.php">Cargar imágenes</a></li>
                <li><a href="./galeria.php">Galería</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Bienvenido, <?php echo $usuario ? htmlspecialchars($usuario['email']) : "Invitado"; ?></h1>
        </div>
    </div>
</body>
</html>