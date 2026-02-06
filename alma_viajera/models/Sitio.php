<?php
require_once 'Database.php';

class Sitio {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Crear un nuevo sitio turístico
    public function crear($datos) {
        $sql = "INSERT INTO sitios (nombre, tipo, descripcion, direccion, ciudad, pais, 
                horario_apertura, horario_cierre, precio_entrada, latitud, longitud) 
                VALUES (:nombre, :tipo, :descripcion, :direccion, :ciudad, :pais, 
                :horario_apertura, :horario_cierre, :precio_entrada, :latitud, :longitud)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':tipo' => $datos['tipo'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':direccion' => $datos['direccion'] ?? null,
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':horario_apertura' => $datos['horario_apertura'] ?? null,
            ':horario_cierre' => $datos['horario_cierre'] ?? null,
            ':precio_entrada' => $datos['precio_entrada'] ?? null,
            ':latitud' => $datos['latitud'] ?? null,
            ':longitud' => $datos['longitud'] ?? null
        ]);
    }
    
    // Obtener todos los sitios
    public function obtenerTodos($filtros = []) {
        $sql = "SELECT * FROM sitios WHERE estado = 'activo'";
        $parametros = [];
        
        if (!empty($filtros['tipo'])) {
            $sql .= " AND tipo = :tipo";
            $parametros[':tipo'] = $filtros['tipo'];
        }
        
        if (!empty($filtros['ciudad'])) {
            $sql .= " AND ciudad LIKE :ciudad";
            $parametros[':ciudad'] = "%{$filtros['ciudad']}%";
        }
        
        if (!empty($filtros['pais'])) {
            $sql .= " AND pais LIKE :pais";
            $parametros[':pais'] = "%{$filtros['pais']}%";
        }
        
        $sql .= " ORDER BY nombre";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }
    
    // Obtener sitio por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM sitios WHERE id_sitio = :id AND estado = 'activo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    // Actualizar sitio
    public function actualizar($id, $datos) {
        $sql = "UPDATE sitios SET nombre = :nombre, tipo = :tipo, descripcion = :descripcion, 
                direccion = :direccion, ciudad = :ciudad, pais = :pais, 
                horario_apertura = :horario_apertura, horario_cierre = :horario_cierre, 
                precio_entrada = :precio_entrada, latitud = :latitud, longitud = :longitud 
                WHERE id_sitio = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre' => $datos['nombre'],
            ':tipo' => $datos['tipo'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':direccion' => $datos['direccion'] ?? null,
            ':ciudad' => $datos['ciudad'],
            ':pais' => $datos['pais'],
            ':horario_apertura' => $datos['horario_apertura'] ?? null,
            ':horario_cierre' => $datos['horario_cierre'] ?? null,
            ':precio_entrada' => $datos['precio_entrada'] ?? null,
            ':latitud' => $datos['latitud'] ?? null,
            ':longitud' => $datos['longitud'] ?? null,
            ':id' => $id
        ]);
    }
    
    // Eliminar sitio
    public function eliminar($id) {
        $sql = "UPDATE sitios SET estado = 'inactivo' WHERE id_sitio = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    // Obtener sitios por tipo
    public function obtenerPorTipo($tipo, $limite = 10) {
        $sql = "SELECT * FROM sitios WHERE tipo = :tipo AND estado = 'activo' 
                ORDER BY nombre LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>