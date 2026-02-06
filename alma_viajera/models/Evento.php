<?php
require_once 'Database.php';

class Evento {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Crear un nuevo evento
    public function crear($datos) {
        $sql = "INSERT INTO eventos (titulo, descripcion, tipo, fecha_inicio, fecha_fin, 
                ubicacion, ciudad, pais, precio, capacidad_maxima, organizador, 
                contacto_email, contacto_telefono) 
                VALUES (:titulo, :descripcion, :tipo, :fecha_inicio, :fecha_fin, 
                :ubicacion, :ciudad, :pais, :precio, :capacidad_maxima, :organizador, 
                :contacto_email, :contacto_telefono)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':titulo' => $datos['titulo'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':tipo' => $datos['tipo'],
            ':fecha_inicio' => $datos['fecha_inicio'],
            ':fecha_fin' => $datos['fecha_fin'] ?? null,
            ':ubicacion' => $datos['ubicacion'],
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':precio' => $datos['precio'] ?? null,
            ':capacidad_maxima' => $datos['capacidad_maxima'] ?? null,
            ':organizador' => $datos['organizador'] ?? null,
            ':contacto_email' => $datos['contacto_email'] ?? null,
            ':contacto_telefono' => $datos['contacto_telefono'] ?? null
        ]);
    }
    
    // Obtener todos los eventos
    public function obtenerTodos($filtros = []) {
        $sql = "SELECT * FROM eventos WHERE estado = 'activo'";
        $parametros = [];
        
        if (!empty($filtros['tipo'])) {
            $sql .= " AND tipo = :tipo";
            $parametros[':tipo'] = $filtros['tipo'];
        }
        
        if (!empty($filtros['ciudad'])) {
            $sql .= " AND ciudad LIKE :ciudad";
            $parametros[':ciudad'] = "%{$filtros['ciudad']}%";
        }
        
        if (!empty($filtros['fecha_desde'])) {
            $sql .= " AND fecha_inicio >= :fecha_desde";
            $parametros[':fecha_desde'] = $filtros['fecha_desde'];
        }
        
        $sql .= " ORDER BY fecha_inicio ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }
    
    // Obtener evento por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM eventos WHERE id_evento = :id AND estado = 'activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    // Actualizar evento
    public function actualizar($id, $datos) {
        $sql = "UPDATE eventos SET titulo = :titulo, descripcion = :descripcion, tipo = :tipo, 
                fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin, ubicacion = :ubicacion, 
                ciudad = :ciudad, pais = :pais, precio = :precio, capacidad_maxima = :capacidad_maxima, 
                organizador = :organizador, contacto_email = :contacto_email, contacto_telefono = :contacto_telefono 
                WHERE id_evento = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':titulo' => $datos['titulo'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':tipo' => $datos['tipo'],
            ':fecha_inicio' => $datos['fecha_inicio'],
            ':fecha_fin' => $datos['fecha_fin'] ?? null,
            ':ubicacion' => $datos['ubicacion'],
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':precio' => $datos['precio'] ?? null,
            ':capacidad_maxima' => $datos['capacidad_maxima'] ?? null,
            ':organizador' => $datos['organizador'] ?? null,
            ':contacto_email' => $datos['contacto_email'] ?? null,
            ':contacto_telefono' => $datos['contacto_telefono'] ?? null,
            ':id' => $id
        ]);
    }
    
    // Eliminar evento
    public function eliminar($id) {
        $sql = "UPDATE eventos SET estado = 'cancelado' WHERE id_evento = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    // Obtener eventos próximos
    public function obtenerProximos($limite = 10) {
        $sql = "SELECT * FROM eventos 
                WHERE estado = 'activo' AND fecha_inicio >= CURDATE() 
                ORDER BY fecha_inicio ASC 
                LIMIT :limite";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // Registrar asistencia a evento
    public function registrarAsistencia($id_evento, $id_usuario) {
        $sql = "INSERT INTO evento_usuario (id_evento, id_usuario, estado_asistencia) 
                VALUES (:id_evento, :id_usuario, 'confirmado')
                ON DUPLICATE KEY UPDATE estado_asistencia = 'confirmado'";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_evento' => $id_evento,
            ':id_usuario' => $id_usuario
        ]);
    }
    
    // Obtener asistentes a evento
    public function obtenerAsistentes($id_evento) {
        $sql = "SELECT u.*, eu.fecha_registro, eu.estado_asistencia 
                FROM evento_usuario eu
                JOIN usuarios u ON eu.id_usuario = u.id_usuario
                WHERE eu.id_evento = :id_evento AND eu.estado_asistencia = 'confirmado'
                ORDER BY eu.fecha_registro";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_evento' => $id_evento]);
        return $stmt->fetchAll();
    }
}
?>