<?php
class AuthController {
    private $usuario;
    
    public function __construct() {
        $this->usuario = new Usuario();
    }
    
    public function showLogin() {
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    public function showRegister() {
        require_once __DIR__ . '/../views/auth/register.php';
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=login");
            exit();
        }
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $user = $this->usuario->findByEmail($email);
        
        if ($user && $this->usuario->verifyPassword($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nombre'] = $user['nombre'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_rol'] = $user['rol'];
            
            $_SESSION['mensaje'] = "Bienvenido " . $user['nombre'];
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: index.php?action=dashboard");
        } else {
            $_SESSION['error'] = "Email o contrasena incorrectos";
            header("Location: index.php?action=login");
        }
        exit();
    }
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=register");
            exit();
        }
        
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmar = $_POST['confirmar_password'] ?? '';
        
        if ($password !== $confirmar) {
            $_SESSION['error'] = "Las contrasenas no coinciden";
            header("Location: index.php?action=register");
            exit();
        }
        
        if (strlen($password) < 6) {
            $_SESSION['error'] = "La contrasena debe tener al menos 6 caracteres";
            header("Location: index.php?action=register");
            exit();
        }
        
        if ($this->usuario->findByEmail($email)) {
            $_SESSION['error'] = "El email ya esta registrado";
            header("Location: index.php?action=register");
            exit();
        }
        
        if ($this->usuario->create($nombre, $email, $password)) {
            $_SESSION['mensaje'] = "Registro exitoso. Ahora puedes iniciar sesion";
            $_SESSION['tipo_mensaje'] = "success";
            header("Location: index.php?action=login");
        } else {
            $_SESSION['error'] = "Error al registrar usuario";
            header("Location: index.php?action=register");
        }
        exit();
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>