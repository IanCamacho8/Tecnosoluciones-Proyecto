<?php
class Cliente {
    private $db;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    public function getAll() {
        $query = "SELECT * FROM clientes ORDER BY nombre";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getById($id) {
        $query = "SELECT * FROM clientes WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function create($nombre, $email, $telefono, $direccion) {
        $query = "INSERT INTO clientes (nombre, email, telefono, direccion) 
                  VALUES (:nombre, :email, :telefono, :direccion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        return $stmt->execute();
    }
    
    public function update($id, $nombre, $email, $telefono, $direccion) {
        $query = "UPDATE clientes SET nombre = :nombre, email = :email, 
                  telefono = :telefono, direccion = :direccion WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
    public function delete($id) {
        $query = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>