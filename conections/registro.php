<?php
// Configuración de la base de datos
$host = "fdb1028.awardspace.net"; 
$dbname = "4557195_proyecto"; 
$username = "4557195_proyecto"; 
$password = "cris.20034"; 

try {
    // Conexión a la base de datos
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
    $confirmar_contrasena = $_POST["confirmar_contrasena"];
    $numero_telefono = $_POST["numero_telefono"];

    // Validaciones básicas
    if (empty($nombre_completo) || empty($email) || empty($contrasena) || empty($confirmar_contrasena) || empty($numero_telefono)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Verificar si las contraseñas coinciden
    if ($contrasena !== $confirmar_contrasena) {
        echo "Las contraseñas no coinciden.";
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
  <h1>Crear una nueva cuenta</h1>
  <!-- Cambiado para enviar al archivo registro.php -->
  <form class="registration-form" action="registro.php" method="POST">
    <div class="form-group">
      <label for="nombre_completo">Nombre completo</label>
      <input type="text" id="nombre_completo" name="nombre_completo" placeholder="Ingresa tu nombre completo" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Ingresa tu Email" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña</label>
      <input type="password" id="password" name="contrasena" placeholder="Ingresa tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirmar contraseña</label>
      <input type="password" id="confirmPassword" name="confirmar_contrasena" placeholder="Confirma tu contraseña" required>
    </div>
    <div class="form-group">
      <label for="phoneNumber">Número de teléfono</label>
      <input type="tel" id="phoneNumber" name="numero_telefono" placeholder="Ingresa tu número de teléfono" required>
    </div>
    <button type="submit" class="btn">Registrarse</button>
  </form>
</div>
</body>
</html>
