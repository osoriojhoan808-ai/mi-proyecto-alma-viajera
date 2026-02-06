<?php
require_once 'Database.php';

class Usuario {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Registrar un nuevo usuario
    public function registrar($datos) {
        $sql = "INSERT INTO usuarios (nombre, email, password_hash, telefono, pais, fecha_nacimiento) 
                VALUES (:nombre, :email, :password_hash, :telefono, :pais, :fecha_nacimiento)";
        
        $stmt = $this->db->prepare($sql);
        
        // Hash de la contraseña
        $password_hash = password_hash($datos['password'], PASSWORD_DEFAULT);
        
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':email' => $datos['email'],
            ':password_hash' => $password_hash,
            ':telefono' => $datos['telefono'] ?? null,
            ':pais' => $datos['pais'] ?? null,
            ':fecha_nacimiento' => $datos['fecha_nacimiento'] ?? null
        ]);
    }
    
    // Iniciar sesión
    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND estado = 'activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($password, $usuario['password_hash'])) {
            // Eliminar password_hash por seguridad
            unset($usuario['password_hash']);
            return $usuario;
        }
        
        return false;
    }
    
    // Verificar si email existe
    public function emailExiste($email) {
        $sql = "SELECT COUNT(*) as count FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $resultado = $stmt->fetch();
        
        return $resultado['count'] > 0;
    }
    
    // Obtener usuario por ID
    public function obtenerPorId($id) {
        $sql = "SELECT id_usuario, nombre, email, fecha_registro, telefono, pais, fecha_nacimiento, avatar_url, tipo 
                FROM usuarios WHERE id_usuario = :id AND estado = 'activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    // Actualizar perfil
    public function actualizar($id, $datos) {
        $sql = "UPDATE usuarios SET nombre = :nombre, telefono = :telefono, 
                pais = :pais, fecha_nacimiento = :fecha_nacimiento 
                WHERE id_usuario = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':telefono' => $datos['telefono'],
            ':pais' => $datos['pais'],
            ':fecha_nacimiento' => $datos['fecha_nacimiento'],
            ':id' => $id
        ]);
    }
    
    // Obtener todos los usuarios (para administradores)
    public function obtenerTodos() {
        $sql = "SELECT id_usuario, nombre, email, fecha_registro, pais, tipo, estado 
                FROM usuarios ORDER BY fecha_registro DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>