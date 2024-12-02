<?php
session_start();

// Configuración de la base de datos
$host = "localhost";
$dbname = "proyecto";
$username = "root";
$password = "";

try {
    // Conexión a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario
$error = ""; // Variable para manejar mensajes de error
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar si los campos están vacíos
    if (empty($email) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        try {
            // Consultar la base de datos para verificar el email
            $sql = "SELECT id_usuario, contrasena FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['contrasena'])) {
                // Iniciar sesión
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['email'] = $email;

                // Redirigir al panel
                header("Location: ../panel/dashboard.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        } catch (PDOException $e) {
            $error = "Error en el servidor: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="./inicio.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="avatar">
                <img src="../images/usuario.svg" alt="Avatar">
            </div>
            <!-- Formulario con método POST que envía los datos al mismo archivo -->
            <form id="loginForm" action="" method="POST">
                <div class="input-group">
                    <label for="email">
                        <span class="icon">📧</span>
                        <input type="email" id="email" name="email" placeholder="Email" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="password">
                        <span class="icon">🔏</span>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </label>
                </div>
                <button type="submit" class="login-btn">INICIAR SESIÓN</button>
                <div class="options">
                    <label>
                        <input type="checkbox"> Recuérdame
                    </label>
                    <a href="./registro.php" class="register-link">Regístrate</a>
                </div>
            </form>
            <!-- Mostrar mensaje de error si existe -->
            <?php if (!empty($error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <script src="./scriptini.js"></script>
</body>
</html>

