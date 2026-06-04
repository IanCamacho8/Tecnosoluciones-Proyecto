<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - TecnoSoluciones</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>TecnoSoluciones S.A.</h1>
            <h2>Registro de Usuario</h2>
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="index.php?action=register">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Contrasena</label>
                    <input type="password" id="password" name="password" required>
                    <small>Minimo 6 caracteres</small>
                </div>
                <div class="form-group">
                    <label for="confirmar_password">Confirmar contrasena</label>
                    <input type="password" id="confirmar_password" name="confirmar_password" required>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
                <p class="text-center">
                    Ya tienes cuenta? <a href="index.php?action=login">Inicia sesion aqui</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>