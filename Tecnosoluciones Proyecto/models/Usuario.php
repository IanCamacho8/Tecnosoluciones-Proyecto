<?php
class Usuario {
    private $db;
    
    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }
    
    public function create($nombre, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }
    
    public function findByEmail($email) {
        $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
?>