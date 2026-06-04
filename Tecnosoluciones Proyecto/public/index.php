<?php
session_start();

define('ROOT_PATH', dirname(__DIR__));

spl_autoload_register(function($class) {
    $paths = [
        ROOT_PATH . '/config/',
        ROOT_PATH . '/controllers/',
        ROOT_PATH . '/models/'
    ];
    
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

$action = $_GET['action'] ?? 'login';

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function redirectToLogin() {
    header("Location: index.php?action=login");
    exit();
}

switch ($action) {
    case 'login':
        if (isLoggedIn()) {
            header("Location: index.php?action=dashboard");
            exit();
        }
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        } else {
            $controller->showLogin();
        }
        break;
        
    case 'register':
        if (isLoggedIn()) {
            header("Location: index.php?action=dashboard");
            exit();
        }
        $controller = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        } else {
            $controller->showRegister();
        }
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'dashboard':
        if (!isLoggedIn()) redirectToLogin();
        require_once ROOT_PATH . '/views/layout/header.php';
        echo '<h2>Panel de Control</h2>';
        echo '<p>Bienvenido al sistema de gestion de proyectos de TecnoSoluciones S.A.</p>';
        echo '<div class="dashboard-cards">';
        echo '<div class="card"><a href="index.php?action=clientes">Clientes</a></div>';
        echo '<div class="card"><a href="index.php?action=proyectos">Proyectos</a></div>';
        echo '<div class="card"><a href="index.php?action=reporte">Reporte PDF</a></div>';
        echo '</div>';
        require_once ROOT_PATH . '/views/layout/footer.php';
        break;
        
    case 'clientes':
        if (!isLoggedIn()) redirectToLogin();
        $controller = new ClienteController();
        
        if ($action2 = $_GET['subaction'] ?? '') {
            if ($action2 === 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } elseif ($action2 === 'editar' && isset($_GET['id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update($_GET['id']);
                } else {
                    $controller->editar($_GET['id']);
                }
            } elseif ($action2 === 'eliminar' && isset($_GET['id'])) {
                $controller->delete($_GET['id']);
            } elseif ($action2 === 'crear') {
                $controller->crear();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    case 'proyectos':
        if (!isLoggedIn()) redirectToLogin();
        $controller = new ProyectoController();
        
        if ($action2 = $_GET['subaction'] ?? '') {
            if ($action2 === 'crear' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->store();
            } elseif ($action2 === 'editar' && isset($_GET['id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->update($_GET['id']);
                } else {
                    $controller->editar($_GET['id']);
                }
            } elseif ($action2 === 'estado' && isset($_GET['id'])) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->updateEstado($_GET['id']);
                }
            } elseif ($action2 === 'eliminar' && isset($_GET['id'])) {
                $controller->delete($_GET['id']);
            } elseif ($action2 === 'crear') {
                $controller->crear();
            } else {
                $controller->index();
            }
        } else {
            $controller->index();
        }
        break;
        
    case 'reporte':
        if (!isLoggedIn()) redirectToLogin();
        $controller = new ProyectoController();
        $controller->reportePdf();
        break;
        
    default:
        header("Location: index.php?action=login");
        break;
}
?>