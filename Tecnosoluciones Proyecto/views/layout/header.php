<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoSoluciones - Gestion de Proyectos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>TecnoSoluciones S.A.</h1>
                <h2>Sistema de Gestion de Proyectos</h2>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-info">
                        <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></span>
                        <a href="index.php?action=logout" class="btn-logout">Cerrar Sesion</a>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <nav>
                    <a href="index.php?action=dashboard">Inicio</a>
                    <a href="index.php?action=clientes">Clientes</a>
                    <a href="index.php?action=proyectos">Proyectos</a>
                    <a href="index.php?action=reporte">Reporte PDF</a>
                </nav>
            <?php endif; ?>
        </header>
        <main>
            <?php if (isset($_SESSION['mensaje'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>