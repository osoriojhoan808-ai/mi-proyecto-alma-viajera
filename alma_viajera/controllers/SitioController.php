<?php
require_once __DIR__ . '/../models/Sitio.php';
require_once __DIR__ . '/../models/Reseña.php';

class SitioController {
    private $sitioModel;
    private $reseñaModel;
    
    public function __construct() {
        $this->sitioModel = new Sitio();
        $this->reseñaModel = new Reseña();
    }
    
    // Listar todos los sitios
    public function index() {
        // Obtener filtros
        $filtros = [];
        if (isset($_GET['tipo'])) $filtros['tipo'] = $_GET['tipo'];
        if (isset($_GET['ciudad'])) $filtros['ciudad'] = $_GET['ciudad'];
        if (isset($_GET['pais'])) $filtros['pais'] = $_GET['pais'];
        
        $sitios = $this->sitioModel->obtenerTodos($filtros);
        
        require_once __DIR__ . '/../views/sitios/index.php';
    }
    
    // Mostrar un sitio específico
    public function show($id) {
        $sitio = $this->sitioModel->obtenerPorId($id);
        
        if (!$sitio) {
            $_SESSION['error'] = "Sitio no encontrado";
            header('Location: index.php?controller=sitio&action=index');
            exit();
        }
        
        // Obtener reseñas del sitio
        $reseñas = $this->reseñaModel->obtenerPorObjeto('sitio', $id);
        
        require_once __DIR__ . '/../views/sitios/show.php';
    }
    
    // Mostrar formulario para crear sitio
    public function create() {
        // Verificar permisos (solo administradores)
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para crear sitios";
            header('Location: index.php?controller=sitio&action=index');
            exit();
        }
        
        // Procesar creación si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->sitioModel->crear($_POST)) {
                $_SESSION['success'] = "Sitio creado exitosamente";
                header('Location: index.php?controller=sitio&action=index');
                exit();
            } else {
                $_SESSION['error'] = "Error al crear el sitio";
            }
        }
        
        require_once __DIR__ . '/../views/sitios/create.php';
    }
    
    // Mostrar formulario para editar sitio
    public function edit($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para editar sitios";
            header('Location: index.php?controller=sitio&action=index');
            exit();
        }
        
        $sitio = $this->sitioModel->obtenerPorId($id);
        
        if (!$sitio) {
            $_SESSION['error'] = "Sitio no encontrado";
            header('Location: index.php?controller=sitio&action=index');
            exit();
        }
        
        // Procesar actualización si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->sitioModel->actualizar($id, $_POST)) {
                $_SESSION['success'] = "Sitio actualizado exitosamente";
                header('Location: index.php?controller=sitio&action=show&id=' . $id);
                exit();
            } else {
                $_SESSION['error'] = "Error al actualizar el sitio";
            }
        }
        
        require_once __DIR__ . '/../views/sitios/edit.php';
    }
    
    // Eliminar sitio
    public function delete($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para eliminar sitios";
            header('Location: index.php?controller=sitio&action=index');
            exit();
        }
        
        if ($this->sitioModel->eliminar($id)) {
            $_SESSION['success'] = "Sitio eliminado exitosamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el sitio";
        }
        
        header('Location: index.php?controller=sitio&action=index');
        exit();
    }
}
?>