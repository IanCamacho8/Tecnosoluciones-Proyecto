<?php
class ClienteController {
    private $cliente;
    
    public function __construct() {
        $this->cliente = new Cliente();
    }
    
    public function index() {
        $clientes = $this->cliente->getAll();
        require_once __DIR__ . '/../views/clientes/index.php';
    }
    
    public function crear() {
        require_once __DIR__ . '/../views/clientes/crear.php';
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=clientes");
            exit();
        }
        
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        
        if ($this->cliente->create($nombre, $email, $telefono, $direccion)) {
            $_SESSION['mensaje'] = "Cliente creado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al crear cliente";
        }
        
        header("Location: index.php?action=clientes");
        exit();
    }
    
    public function editar($id) {
        $cliente = $this->cliente->getById($id);
        if (!$cliente) {
            $_SESSION['error'] = "Cliente no encontrado";
            header("Location: index.php?action=clientes");
            exit();
        }
        require_once __DIR__ . '/../views/clientes/editar.php';
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=clientes");
            exit();
        }
        
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        
        if ($this->cliente->update($id, $nombre, $email, $telefono, $direccion)) {
            $_SESSION['mensaje'] = "Cliente actualizado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al actualizar cliente";
        }
        
        header("Location: index.php?action=clientes");
        exit();
    }
    
    public function delete($id) {
        if ($this->cliente->delete($id)) {
            $_SESSION['mensaje'] = "Cliente eliminado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al eliminar cliente";
        }
        
        header("Location: index.php?action=clientes");
        exit();
    }
}
?>