<?php
// Configuración de la base de datos
$host = "localhost"; // Cambia esto si tu base de datos está en otro servidor
$dbname = "proyecto"; // Nombre de tu base de datos
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos

try {
    // Conexión a la base de datos usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo = $_POST["nombre_completo"];
    $email = $_POST["email"];
    $contrasena = $_POST["contrasena"];
    $numero_telefono = $_POST["numero_telefono"];

    // Validaciones básicas
    if (empty($nombre_completo) || empty($email) || empty($contrasena) || empty($numero_telefono)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Cifrar la contraseña
    $contrasena_cifrada = password_hash($contrasena, PASSWORD_BCRYPT);

    try {
        // Insertar el usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre_completo, email, contrasena, numero_telefono) 
                VALUES (:nombre_completo, :email, :contrasena, :numero_telefono)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_completo', $nombre_completo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena_cifrada);
        $stmt->bindParam(':numero_telefono', $numero_telefono);
        $stmt->execute();

        echo "Registro exitoso.";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Código para errores de duplicación (email único)
            echo "El email ya está registrado.";
        } else {
            echo "Error al registrar el usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./registro.css">
</head>
<body>
<div class="container">
  <h1>Crear una cuenta</h1>
  <form class="registration-form">
    <div class="form-group">
      <label for="fullName">Nombre completo</label>
      <input type="text" id="fullName" placeholder="Ingresa tu nombre completo" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Ingresa tu Email" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" placeholder="Ingresa tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="confirmPassword">confirmar contraseña</label>
      <input type="password" id="confirmPassword" placeholder="Confirma tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="phoneNumber">Numero de telefono</label>
      <input type="tel" id="phoneNumber" placeholder="Ingresa tu numero de telefono" required>
    </div>
    <button type="submit" class="btn">Resgistrarse</button>
  </form>
</div>
    <script src="./scriptini.js"></script>
</body>
</html>
