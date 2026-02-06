<?php
// Configuración de la base de datos Alma Viajera
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '190523');
define('DB_NAME', 'alma_viajera');
define('DB_CHARSET', 'utf8mb4');

// Función para conectar a la base de datos
function getDBConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}
?>