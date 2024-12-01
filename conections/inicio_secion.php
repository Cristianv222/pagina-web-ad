<?php
session_start(); // Inicia la sesión

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "proyecto");

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar usuario
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; // Guardar ID en sesión
            $_SESSION['username'] = $user['username'];
            header("Location: ../panel/dashboard.php"); // Redirigir al dashboard
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
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
            <form id="loginForm">
                <div class="input-group">
                    <label for="email">
                        <span class="icon">📧</span>
                        <input type="email" id="email" placeholder="Email" required>
                    </label>
                </div>
                <div class="input-group">
                    <label for="password">
                        <span class="icon">🔏</span>
                        <input type="password" id="password" placeholder="Contraseña" required>
                    </label>
                </div>
                <button type="submit" class="login-btn">INICIAR SESION</button>
                <div class="options">
                    <label>
                        <input type="checkbox"> Recuerdame
                    </label>
                    <a href="./registro.php" class="register-link">Regístrate</a>
                </div>
            </form>
        </div>
    </div>
    <script src="./scriptini.js"></script>
</body>
</html>
