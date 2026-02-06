<?php
require_once 'Database.php';

class Hotel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Crear un nuevo hotel
    public function crear($datos) {
        $sql = "INSERT INTO hoteles (nombre, direccion, ciudad, pais, telefono, email, sitio_web, 
                categoria, precio_promedio, latitud, longitud, descripcion) 
                VALUES (:nombre, :direccion, :ciudad, :pais, :telefono, :email, :sitio_web, 
                :categoria, :precio_promedio, :latitud, :longitud, :descripcion)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':direccion' => $datos['direccion'],
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':telefono' => $datos['telefono'] ?? null,
            ':email' => $datos['email'] ?? null,
            ':sitio_web' => $datos['sitio_web'] ?? null,
            ':categoria' => $datos['categoria'] ?? null,
            ':precio_promedio' => $datos['precio_promedio'] ?? null,
            ':latitud' => $datos['latitud'] ?? null,
            ':longitud' => $datos['longitud'] ?? null,
            ':descripcion' => $datos['descripcion'] ?? null
        ]);
    }
    
    // Obtener todos los hoteles
    public function obtenerTodos($filtros = []) {
        $sql = "SELECT * FROM hoteles WHERE estado = 'activo'";
        $parametros = [];
        
        if (!empty($filtros['ciudad'])) {
            $sql .= " AND ciudad LIKE :ciudad";
            $parametros[':ciudad'] = "%{$filtros['ciudad']}%";
        }
        
        if (!empty($filtros['pais'])) {
            $sql .= " AND pais LIKE :pais";
            $parametros[':pais'] = "%{$filtros['pais']}%";
        }
        
        if (!empty($filtros['categoria'])) {
            $sql .= " AND categoria = :categoria";
            $parametros[':categoria'] = $filtros['categoria'];
        }
        
        if (!empty($filtros['precio_max'])) {
            $sql .= " AND precio_promedio <= :precio_max";
            $parametros[':precio_max'] = $filtros['precio_max'];
        }
        
        $sql .= " ORDER BY nombre";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }
    
    // Obtener hotel por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM hoteles WHERE id_hotel = :id AND estado = 'activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    // Actualizar hotel
    public function actualizar($id, $datos) {
        $sql = "UPDATE hoteles SET nombre = :nombre, direccion = :direccion, ciudad = :ciudad, 
                pais = :pais, telefono = :telefono, email = :email, sitio_web = :sitio_web, 
                categoria = :categoria, precio_promedio = :precio_promedio, 
                latitud = :latitud, longitud = :longitud, descripcion = :descripcion 
                WHERE id_hotel = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':direccion' => $datos['direccion'],
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':telefono' => $datos['telefono'] ?? null,
            ':email' => $datos['email'] ?? null,
            ':sitio_web' => $datos['sitio_web'] ?? null,
            ':categoria' => $datos['categoria'] ?? null,
            ':precio_promedio' => $datos['precio_promedio'] ?? null,
            ':latitud' => $datos['latitud'] ?? null,
            ':longitud' => $datos['longitud'] ?? null,
            ':descripcion' => $datos['descripcion'] ?? null,
            ':id' => $id
        ]);
    }
    
    // Eliminar hotel (cambiar estado)
    public function eliminar($id) {
        $sql = "UPDATE hoteles SET estado = 'inactivo' WHERE id_hotel = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    // Obtener hoteles mejor valorados
    public function obtenerMejorValorados($limite = 10) {
        $sql = "SELECT h.*, 
                COALESCE(AVG(r.calificacion), 0) as promedio_calificacion,
                COUNT(r.id_reseña) as total_reseñas
                FROM hoteles h
                LEFT JOIN reseñas r ON h.id_hotel = r.id_objeto AND r.tipo_objeto = 'hotel' AND r.estado = 'activa'
                WHERE h.estado = 'activo'
                GROUP BY h.id_hotel
                ORDER BY promedio_calificacion DESC, total_reseñas DESC
                LIMIT :limite";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>