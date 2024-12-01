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
