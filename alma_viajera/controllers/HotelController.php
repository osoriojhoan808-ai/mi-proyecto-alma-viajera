<?php
require_once __DIR__ . '/../models/Hotel.php';
require_once __DIR__ . '/../models/Reseña.php';

class HotelController {
    private $hotelModel;
    private $reseñaModel;
    
    public function __construct() {
        $this->hotelModel = new Hotel();
        $this->reseñaModel = new Reseña();
    }
    
    // Listar todos los hoteles
    public function index() {
        // Obtener filtros
        $filtros = [];
        if (isset($_GET['ciudad'])) $filtros['ciudad'] = $_GET['ciudad'];
        if (isset($_GET['pais'])) $filtros['pais'] = $_GET['pais'];
        if (isset($_GET['categoria'])) $filtros['categoria'] = $_GET['categoria'];
        if (isset($_GET['precio_max'])) $filtros['precio_max'] = $_GET['precio_max'];
        
        $hoteles = $this->hotelModel->obtenerTodos($filtros);
        
        require_once __DIR__ . '/../views/hotels/index.php';
    }
    
    // Mostrar un hotel específico
    public function show($id) {
        $hotel = $this->hotelModel->obtenerPorId($id);
        
        if (!$hotel) {
            $_SESSION['error'] = "Hotel no encontrado";
            header('Location: index.php?controller=hotel&action=index');
            exit();
        }
        
        // Obtener reseñas del hotel
        $reseñas = $this->reseñaModel->obtenerPorObjeto('hotel', $id);
        
        require_once __DIR__ . '/../views/hotels/show.php';
    }
    
    // Mostrar formulario para crear hotel
    public function create() {
        // Verificar permisos (solo administradores)
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para crear hoteles";
            header('Location: index.php?controller=hotel&action=index');
            exit();
        }
        
        // Procesar creación si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->hotelModel->crear($_POST)) {
                $_SESSION['success'] = "Hotel creado exitosamente";
                header('Location: index.php?controller=hotel&action=index');
                exit();
            } else {
                $_SESSION['error'] = "Error al crear el hotel";
            }
        }
        
        require_once __DIR__ . '/../views/hotels/create.php';
    }
    
    // Mostrar formulario para editar hotel
    public function edit($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para editar hoteles";
            header('Location: index.php?controller=hotel&action=index');
            exit();
        }
        
        $hotel = $this->hotelModel->obtenerPorId($id);
        
        if (!$hotel) {
            $_SESSION['error'] = "Hotel no encontrado";
            header('Location: index.php?controller=hotel&action=index');
            exit();
        }
        
        // Procesar actualización si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->hotelModel->actualizar($id, $_POST)) {
                $_SESSION['success'] = "Hotel actualizado exitosamente";
                header('Location: index.php?controller=hotel&action=show&id=' . $id);
                exit();
            } else {
                $_SESSION['error'] = "Error al actualizar el hotel";
            }
        }
        
        require_once __DIR__ . '/../views/hotels/edit.php';
    }
    
    // Eliminar hotel
    public function delete($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para eliminar hoteles";
            header('Location: index.php?controller=hotel&action=index');
            exit();
        }
        
        if ($this->hotelModel->eliminar($id)) {
            $_SESSION['success'] = "Hotel eliminado exitosamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el hotel";
        }
        
        header('Location: index.php?controller=hotel&action=index');
        exit();
    }
}
?>