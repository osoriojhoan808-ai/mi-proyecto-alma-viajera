<?php
require_once 'Database.php';

class Reseña {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Crear una nueva reseña
    public function crear($datos) {
        $sql = "INSERT INTO reseñas (id_usuario, tipo_objeto, id_objeto, calificacion, comentario) 
                VALUES (:id_usuario, :tipo_objeto, :id_objeto, :calificacion, :comentario)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $datos['id_usuario'],
            ':tipo_objeto' => $datos['tipo_objeto'],
            ':id_objeto' => $datos['id_objeto'],
            ':calificacion' => $datos['calificacion'],
            ':comentario' => $datos['comentario'] ?? null
        ]);
    }
    
    // Obtener reseñas por objeto
    public function obtenerPorObjeto($tipo_objeto, $id_objeto) {
        $sql = "SELECT r.*, u.nombre as usuario_nombre, u.avatar_url 
                FROM reseñas r
                JOIN usuarios u ON r.id_usuario = u.id_usuario
                WHERE r.tipo_objeto = :tipo_objeto 
                AND r.id_objeto = :id_objeto 
                AND r.estado = 'activa'
                ORDER BY r.fecha_reseña DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':tipo_objeto' => $tipo_objeto,
            ':id_objeto' => $id_objeto
        ]);
        return $stmt->fetchAll();
    }
    
    // Obtener reseñas por usuario
    public function obtenerPorUsuario($id_usuario) {
        $sql = "SELECT r.*, 
                CASE 
                    WHEN r.tipo_objeto = 'hotel' THEN h.nombre
                    WHEN r.tipo_objeto = 'sitio' THEN s.nombre
                    WHEN r.tipo_objeto = 'evento' THEN e.titulo
                    WHEN r.tipo_objeto = 'transporte' THEN CONCAT(t.origen, ' - ', t.destino)
                END as objeto_nombre
                FROM reseñas r
                LEFT JOIN hoteles h ON r.tipo_objeto = 'hotel' AND r.id_objeto = h.id_hotel
                LEFT JOIN sitios s ON r.tipo_objeto = 'sitio' AND r.id_objeto = s.id_sitio
                LEFT JOIN eventos e ON r.tipo_objeto = 'evento' AND r.id_objeto = e.id_evento
                LEFT JOIN transporte t ON r.tipo_objeto = 'transporte' AND r.id_objeto = t.id_transporte
                WHERE r.id_usuario = :id_usuario AND r.estado = 'activa'
                ORDER BY r.fecha_reseña DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_usuario' => $id_usuario]);
        return $stmt->fetchAll();
    }
    
    // Obtener calificación promedio
    public function obtenerCalificacionPromedio($tipo_objeto, $id_objeto) {
        $sql = "SELECT AVG(calificacion) as promedio, COUNT(*) as total 
                FROM reseñas 
                WHERE tipo_objeto = :tipo_objeto 
                AND id_objeto = :id_objeto 
                AND estado = 'activa'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':tipo_objeto' => $tipo_objeto,
            ':id_objeto' => $id_objeto
        ]);
        return $stmt->fetch();
    }
    
    // Actualizar reseña
    public function actualizar($id_reseña, $datos) {
        $sql = "UPDATE reseñas SET calificacion = :calificacion, comentario = :comentario 
                WHERE id_reseña = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':calificacion' => $datos['calificacion'],
            ':comentario' => $datos['comentario'],
            ':id' => $id_reseña
        ]);
    }
    
    // Eliminar reseña
    public function eliminar($id_reseña) {
        $sql = "UPDATE reseñas SET estado = 'eliminada' WHERE id_reseña = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id_reseña]);
    }
}
?>