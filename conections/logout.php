<?php
session_start(); // Inicia la sesión para acceder a las variables

// Destruye la sesión
session_unset(); // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Redirige al usuario a la página de inicio
header("Location: index.php");
exit(); // Asegura que el script se detenga después de la redirección
?>