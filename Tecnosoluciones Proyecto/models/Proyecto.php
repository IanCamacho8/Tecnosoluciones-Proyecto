<?php
class Proyecto {
    private $db;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT p.*, c.nombre as cliente_nombre 
                  FROM proyectos p 
                  JOIN clientes c ON p.cliente_id = c.id 
                  ORDER BY p.id DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $query = "SELECT p.*, c.nombre as cliente_nombre 
                  FROM proyectos p 
                  JOIN clientes c ON p.cliente_id = c.id 
                  WHERE p.id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function create($nombre_proyecto, $cliente_id, $descripcion, $monto) {
        $query = "INSERT INTO proyectos (nombre_proyecto, cliente_id, descripcion, monto) 
                  VALUES (:nombre_proyecto, :cliente_id, :descripcion, :monto)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
        $stmt->bindParam(':cliente_id', $cliente_id);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':monto', $monto);
        return $stmt->execute();
    }
    
    public function update($id, $nombre_proyecto, $cliente_id, $descripcion, $estado, $monto) {
        $query = "UPDATE proyectos SET nombre_proyecto = :nombre_proyecto, 
                  cliente_id = :cliente_id, descripcion = :descripcion, 
                  estado = :estado, monto = :monto WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre_proyecto', $nombre_proyecto);
        $stmt->bindParam(':cliente_id', $cliente_id);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':monto', $monto);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function updateEstado($id, $estado) {
        $query = "UPDATE proyectos SET estado = :estado WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM proyectos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function getEstados() {
        return ['recibido', 'validado', 'en_preparacion', 'despachado', 'confirmado'];
    }
}
?>