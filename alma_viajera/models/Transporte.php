<?php
require_once 'Database.php';

class Transporte {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Crear un nuevo transporte
    public function crear($datos) {
        $sql = "INSERT INTO transporte (tipo, compania, numero_vuelo_tren, origen, destino, 
                fecha_hora_salida, fecha_hora_llegada, precio, duracion_minutos, 
                asientos_disponibles, informacion_adicional) 
                VALUES (:tipo, :compania, :numero_vuelo_tren, :origen, :destino, 
                :fecha_hora_salida, :fecha_hora_llegada, :precio, :duracion_minutos, 
                :asientos_disponibles, :informacion_adicional)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':tipo' => $datos['tipo'],
            ':compania' => $datos['compania'],
            ':numero_vuelo_tren' => $datos['numero_vuelo_tren'] ?? null,
            ':origen' => $datos['origen'],
            ':destino' => $datos['destino'],
            ':fecha_hora_salida' => $datos['fecha_hora_salida'],
            ':fecha_hora_llegada' => $datos['fecha_hora_llegada'] ?? null,
            ':precio' => $datos['precio'] ?? null,
            ':duracion_minutos' => $datos['duracion_minutos'] ?? null,
            ':asientos_disponibles' => $datos['asientos_disponibles'] ?? null,
            ':informacion_adicional' => $datos['informacion_adicional'] ?? null
        ]);
    }
    
    // Obtener todos los transportes
    public function obtenerTodos($filtros = []) {
        $sql = "SELECT * FROM transporte WHERE estado = 'programado'";
        $parametros = [];
        
        if (!empty($filtros['tipo'])) {
            $sql .= " AND tipo = :tipo";
            $parametros[':tipo'] = $filtros['tipo'];
        }
        
        if (!empty($filtros['origen'])) {
            $sql .= " AND origen LIKE :origen";
            $parametros[':origen'] = "%{$filtros['origen']}%";
        }
        
        if (!empty($filtros['destino'])) {
            $sql .= " AND destino LIKE :destino";
            $parametros[':destino'] = "%{$filtros['destino']}%";
        }
        
        if (!empty($filtros['fecha'])) {
            $sql .= " AND DATE(fecha_hora_salida) = :fecha";
            $parametros[':fecha'] = $filtros['fecha'];
        }
        
        $sql .= " ORDER BY fecha_hora_salida ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll();
    }
    
    // Obtener transporte por ID
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM transporte WHERE id_transporte = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    // Actualizar transporte
    public function actualizar($id, $datos) {
        $sql = "UPDATE transporte SET tipo = :tipo, compania = :compania, 
                numero_vuelo_tren = :numero_vuelo_tren, origen = :origen, destino = :destino, 
                fecha_hora_salida = :fecha_hora_salida, fecha_hora_llegada = :fecha_hora_llegada, 
                precio = :precio, duracion_minutos = :duracion_minutos, 
                asientos_disponibles = :asientos_disponibles, 
                informacion_adicional = :informacion_adicional 
                WHERE id_transporte = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':tipo' => $datos['tipo'],
            ':compania' => $datos['compania'],
            ':numero_vuelo_tren' => $datos['numero_vuelo_tren'] ?? null,
            ':origen' => $datos['origen'],
            ':destino' => $datos['destino'],
            ':fecha_hora_salida' => $datos['fecha_hora_salida'],
            ':fecha_hora_llegada' => $datos['fecha_hora_llegada'] ?? null,
            ':precio' => $datos['precio'] ?? null,
            ':duracion_minutos' => $datos['duracion_minutos'] ?? null,
            ':asientos_disponibles' => $datos['asientos_disponibles'] ?? null,
            ':informacion_adicional' => $datos['informacion_adicional'] ?? null,
            ':id' => $id
        ]);
    }
    
    // Eliminar transporte
    public function eliminar($id) {
        $sql = "UPDATE transporte SET estado = 'cancelado' WHERE id_transporte = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
    // Buscar rutas
    public function buscarRutas($origen, $destino, $fecha) {
        $sql = "SELECT * FROM transporte 
                WHERE origen LIKE :origen AND destino LIKE :destino 
                AND DATE(fecha_hora_salida) = :fecha 
                AND estado = 'programado'
                ORDER BY fecha_hora_salida ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':origen' => "%$origen%",
            ':destino' => "%$destino%",
            ':fecha' => $fecha
        ]);
        return $stmt->fetchAll();
    }
}
?>