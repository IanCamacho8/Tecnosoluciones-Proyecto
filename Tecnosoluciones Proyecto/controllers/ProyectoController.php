<?php
class ProyectoController {
    private $proyecto;
    private $cliente;
    
    public function __construct() {
        $this->proyecto = new Proyecto();
        $this->cliente = new Cliente();
    }
    
    public function index() {
        $proyectos = $this->proyecto->getAll();
        require_once __DIR__ . '/../views/proyectos/index.php';
    }
    
    public function crear() {
        $clientes = $this->cliente->getAll();
        $estados = $this->proyecto->getEstados();
        require_once __DIR__ . '/../views/proyectos/crear.php';
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=proyectos");
            exit();
        }
        
        $nombre_proyecto = $_POST['nombre_proyecto'] ?? '';
        $cliente_id = $_POST['cliente_id'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $monto = $_POST['monto'] ?? 0;
        
        if ($this->proyecto->create($nombre_proyecto, $cliente_id, $descripcion, $monto)) {
            $_SESSION['mensaje'] = "Proyecto creado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al crear proyecto";
        }
        
        header("Location: index.php?action=proyectos");
        exit();
    }
    
    public function editar($id) {
        $proyecto = $this->proyecto->getById($id);
        if (!$proyecto) {
            $_SESSION['error'] = "Proyecto no encontrado";
            header("Location: index.php?action=proyectos");
            exit();
        }
        $clientes = $this->cliente->getAll();
        $estados = $this->proyecto->getEstados();
        require_once __DIR__ . '/../views/proyectos/editar.php';
    }
    
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=proyectos");
            exit();
        }
        
        $nombre_proyecto = $_POST['nombre_proyecto'] ?? '';
        $cliente_id = $_POST['cliente_id'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $estado = $_POST['estado'] ?? 'recibido';
        $monto = $_POST['monto'] ?? 0;
        
        if ($this->proyecto->update($id, $nombre_proyecto, $cliente_id, $descripcion, $estado, $monto)) {
            $_SESSION['mensaje'] = "Proyecto actualizado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al actualizar proyecto";
        }
        
        header("Location: index.php?action=proyectos");
        exit();
    }
    
    public function updateEstado($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=proyectos");
            exit();
        }
        
        $estado = $_POST['estado'] ?? 'recibido';
        
        if ($this->proyecto->updateEstado($id, $estado)) {
            $_SESSION['mensaje'] = "Estado del proyecto actualizado";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al actualizar estado";
        }
        
        header("Location: index.php?action=proyectos");
        exit();
    }
    
    public function delete($id) {
        if ($this->proyecto->delete($id)) {
            $_SESSION['mensaje'] = "Proyecto eliminado exitosamente";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['error'] = "Error al eliminar proyecto";
        }
        
        header("Location: index.php?action=proyectos");
        exit();
    }
    
    public function reportePdf() {
        $proyectos = $this->proyecto->getAll();
        
        // Incluir el autoload de Composer
        require_once __DIR__ . '/../vendor/autoload.php';
        
        $dompdf = new Dompdf\Dompdf();
        
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Reporte de Proyectos</title>
            <style>
                body { font-family: Arial, sans-serif; }
                h1 { color: #2c3e50; text-align: center; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th { background-color: #3498db; color: white; padding: 10px; }
                td { border: 1px solid #ddd; padding: 8px; }
                .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #777; }
            </style>
        </head>
        <body>
            <h1>TecnoSoluciones S.A.</h1>
            <h2>Reporte de Proyectos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Proyecto</th>
                        <th>Cliente</th>
                        <th>Estado</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>';
        
        foreach ($proyectos as $p) {
            $html .= '<tr>
                        <td>' . $p['id'] . '</td>
                        <td>' . htmlspecialchars($p['nombre_proyecto']) . '</td>
                        <td>' . htmlspecialchars($p['cliente_nombre']) . '</td>
                        <td>' . $p['estado'] . '</td>
                        <td>S/ ' . number_format($p['monto'], 2) . '</td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>
            <div class="footer">
                <p>Reporte generado el ' . date('d/m/Y H:i:s') . '</p>
            </div>
        </body>
        </html>';
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte_proyectos.pdf", ["Attachment" => true]);
    }
}
?>