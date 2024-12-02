<?php
session_start();
include './db.php';

// Verifica si el usuario está logueado, si no lo está, redirige al login
if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../conections/inicio_secion.php');
    exit();
}

// Obtener el id del usuario desde la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consultar los datos del usuario (en este caso, el email)
$result = $conn->query("SELECT email FROM usuarios WHERE id_usuario = $id_usuario");

if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc(); // Asigna la información del usuario a la variable
} else {
    $usuario = null; // Si no se encuentra el usuario, asigna null
}

// Lógica para la carga de imágenes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $descripcion = $_POST['descripcion'];

    // Define la ruta de la carpeta de destino
    $upload_dir = 'uploads/';

    // Verifica si la carpeta 'uploads/' existe, y si no, la crea
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0777, true)) {
            echo "Error al crear la carpeta 'uploads/'. Verifica los permisos del servidor.";
            exit();
        }
    }

    // Obtén la ruta completa del archivo a subir
    $ruta_foto = $upload_dir . basename($_FILES['foto']['name']);

    // Verifica si el archivo se mueve correctamente
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_foto)) {
        // Si la carga es exitosa, inserta la información en la base de datos
        $stmt = $conn->prepare("INSERT INTO fotos (id_usuario, ruta_foto, descripcion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $id_usuario, $ruta_foto, $descripcion);
        $stmt->execute();
        $stmt->close();

        // Redirige a la galería después de la carga
        header("Location: ./galeria.php");
        exit();
    } else {
        // Si ocurre un error al mover el archivo
        echo "Error al subir la imagen. Verifica que la carpeta 'uploads/' tenga permisos de escritura.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Imágenes</title>
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
                <li><a href="./upload.php" class="active">Cargar imágenes</a></li>
                <li><a href="./galeria.php">Galería</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Cargar Imágenes</h1>
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="upload-form">
                <div class="form-group">
                    <label for="foto">Selecciona una imagen:</label>
                    <input type="file" name="foto" id="foto" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" placeholder="Describe brevemente la imagen"></textarea>
                </div>
                <button type="submit" class="upload-btn">Subir Imagen</button>
            </form>
        </div>
    </div>
</body>
</html>

<style>
    /* Contenedor principal */
.container {
    display: flex;
    height: 100vh;
}

/* Topbar */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #333;
    color: white;
    padding: 10px 20px;
}

.logo-img {
    height: 40px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.logout-btn {
    color: white;
    background-color: #d9534f;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}

.logout-btn:hover {
    background-color: #c9302c;
}

/* Sidebar */
.sidebar {
    width: 200px;
    background-color: #2c3e50;
    color: white;
    display: flex;
    flex-direction: column;
    padding: 20px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-size: 16px;
}

.sidebar ul li a.active {
    font-weight: bold;
    text-decoration: underline;
}

/* Main content */
.main-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #ecf0f1;
}

h1 {
    margin-bottom: 20px;
}

/* Formulario */
.upload-form {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
}

.upload-form .form-group {
    margin-bottom: 15px;
}

.upload-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.upload-form input[type="file"],
.upload-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.upload-form .upload-btn {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.upload-form .upload-btn:hover {
    background-color: #2980b9;
}

</style>