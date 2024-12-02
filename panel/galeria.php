<?php
session_start();
include './auth.php';

$id_usuario = $_SESSION['id_usuario'];
$result = $conn->query("SELECT * FROM fotos WHERE id_usuario = $id_usuario");

$fotos = [];
while ($row = $result->fetch_assoc()) {
    $fotos[] = $row;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería - Panel de Usuario</title>
    <link rel="stylesheet" href="styles.css">
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
                <li><a href="upload.php">Cargar imágenes</a></li>
                <li><a href="galeria.php">Galería</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Galería de Imágenes</h1>

            <div class="gallery">
                <?php foreach ($fotos as $foto): ?>
                    <div class="card">
                        <img src="<?php echo $foto['ruta_foto']; ?>" alt="Foto" class="gallery-image">
                        <p><?php echo htmlspecialchars($foto['descripcion']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>

<style>
    /* Estilos Generales */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.topbar {
    background-color: #333;
    color: white;
    padding: 10px 0;
    text-align: center;
}

.topbar .logo img {
    height: 50px;
}

.topbar .user-info {
    text-align: right;
    padding: 10px;
}

.topbar .user-info .logout-btn {
    background-color: #f44336;
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

.topbar .user-info .logout-btn:hover {
    background-color: #d32f2f;
}

.sidebar {
    width: 200px;
    background-color: #333;
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
}

.sidebar ul li a:hover {
    color: #f44336;
}

.main-content {
    margin-left: 220px;
    padding: 20px;
    background-color: #fff;
    flex-grow: 1;
}

/* Estilos para la galería */
.gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Espacio entre las tarjetas */
    justify-content: flex-start;
    padding: 10px;
}

.card {
    width: calc(33.33% - 20px); /* Tres columnas horizontales */
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    background-color: #fff;
    text-align: center;
}

.card img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

.card p {
    margin-top: 10px;
    font-size: 14px;
    color: #555;
}

/* Hacer que las tarjetas se ajusten en pantallas pequeñas */
@media (max-width: 768px) {
    .card {
        width: calc(50% - 20px); /* Dos columnas */
    }
}

@media (max-width: 480px) {
    .card {
        width: 100%; /* Una columna */
    }
}

</style>
