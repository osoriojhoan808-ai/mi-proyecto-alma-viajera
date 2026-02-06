<?php
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Sitio.php';
require_once __DIR__ . '/../models/Evento.php';
require_once __DIR__ . '/../models/Transporte.php';

class DashboardController {
    private $hotelModel;
    private $sitioModel;
    private $eventoModel;
    private $transporteModel;
    
    public function __construct() {
        $this->hotelModel = new Hotel();
        $this->sitioModel = new Sitio();
        $this->eventoModel = new Evento();
        $this->transporteModel = new Transporte();
    }
    
    // Página principal del dashboard
    public function index() {
        // No requiere autenticación - tanto invitados como usuarios registrados pueden verlo
        
        // Obtener algunos datos destacados para mostrar
        $hotelesDestacados = $this->hotelModel->obtenerTodos([]);
        $sitiosDestacados = $this->sitioModel->obtenerTodos([]);
        $eventosProximos = $this->eventoModel->obtenerProximos(3);
        
        // Limitar la cantidad si hay muchos
        if (count($hotelesDestacados) > 6) {
            $hotelesDestacados = array_slice($hotelesDestacados, 0, 6);
        }
        
        if (count($sitiosDestacados) > 6) {
            $sitiosDestacados = array_slice($sitiosDestacados, 0, 6);
        }
        
        // Pasar datos a la vista
        $datos = [
            'hoteles' => $hotelesDestacados,
            'sitios' => $sitiosDestacados,
            'eventos' => $eventosProximos
        ];
        
        // Cargar vista del dashboard
        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}
?>