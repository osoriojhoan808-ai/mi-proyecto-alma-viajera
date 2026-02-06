<?php
require_once __DIR__ . '/../models/Evento.php';
require_once __DIR__ . '/../models/Reseña.php';

class EventoController {
    private $eventoModel;
    private $reseñaModel;
    
    public function __construct() {
        $this->eventoModel = new Evento();
        $this->reseñaModel = new Reseña();
    }
    
    // Listar todos los eventos
    public function index() {
        // Obtener filtros
        $filtros = [];
        if (isset($_GET['tipo'])) $filtros['tipo'] = $_GET['tipo'];
        if (isset($_GET['ciudad'])) $filtros['ciudad'] = $_GET['ciudad'];
        if (isset($_GET['fecha_desde'])) $filtros['fecha_desde'] = $_GET['fecha_desde'];
        
        $eventos = $this->eventoModel->obtenerTodos($filtros);
        
        require_once __DIR__ . '/../views/eventos/index.php';
    }
    
    // Mostrar un evento específico
    public function show($id) {
        $evento = $this->eventoModel->obtenerPorId($id);
        
        if (!$evento) {
            $_SESSION['error'] = "Evento no encontrado";
            header('Location: index.php?controller=evento&action=index');
            exit();
        }
        
        // Obtener reseñas del evento
        $reseñas = $this->reseñaModel->obtenerPorObjeto('evento', $id);
        
        // Obtener asistentes si el usuario es el organizador o administrador
        $asistentes = [];
        if (isset($_SESSION['user']) && 
            ($_SESSION['user']['tipo'] === 'administrador' || 
             $_SESSION['user']['id_usuario'] == $evento['id_usuario'])) {
            $asistentes = $this->eventoModel->obtenerAsistentes($id);
        }
        
        require_once __DIR__ . '/../views/eventos/show.php';
    }
    
    // Mostrar formulario para crear evento
    public function create() {
        // Verificar permisos (administradores y guías)
        if (!isset($_SESSION['user']) || 
            ($_SESSION['user']['tipo'] !== 'administrador' && $_SESSION['user']['tipo'] !== 'guia')) {
            $_SESSION['error'] = "No tienes permisos para crear eventos";
            header('Location: index.php?controller=evento&action=index');
            exit();
        }
        
        // Procesar creación si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->eventoModel->crear($_POST)) {
                $_SESSION['success'] = "Evento creado exitosamente";
                header('Location: index.php?controller=evento&action=index');
                exit();
            } else {
                $_SESSION['error'] = "Error al crear el evento";
            }
        }
        
        require_once __DIR__ . '/../views/eventos/create.php';
    }
    
    // Mostrar formulario para editar evento
    public function edit($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || 
            ($_SESSION['user']['tipo'] !== 'administrador' && $_SESSION['user']['tipo'] !== 'guia')) {
            $_SESSION['error'] = "No tienes permisos para editar eventos";
            header('Location: index.php?controller=evento&action=index');
            exit();
        }
        
        $evento = $this->eventoModel->obtenerPorId($id);
        
        if (!$evento) {
            $_SESSION['error'] = "Evento no encontrado";
            header('Location: index.php?controller=evento&action=index');
            exit();
        }
        
        // Procesar actualización si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->eventoModel->actualizar($id, $_POST)) {
                $_SESSION['success'] = "Evento actualizado exitosamente";
                header('Location: index.php?controller=evento&action=show&id=' . $id);
                exit();
            } else {
                $_SESSION['error'] = "Error al actualizar el evento";
            }
        }
        
        require_once __DIR__ . '/../views/eventos/edit.php';
    }
    
    // Eliminar evento
    public function delete($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || 
            ($_SESSION['user']['tipo'] !== 'administrador' && $_SESSION['user']['tipo'] !== 'guia')) {
            $_SESSION['error'] = "No tienes permisos para eliminar eventos";
            header('Location: index.php?controller=evento&action=index');
            exit();
        }
        
        if ($this->eventoModel->eliminar($id)) {
            $_SESSION['success'] = "Evento eliminado exitosamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el evento";
        }
        
        header('Location: index.php?controller=evento&action=index');
        exit();
    }
    
    // Registrar asistencia a evento
    public function registrar($id) {
        // Verificar que el usuario esté logueado
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = "Debes iniciar sesión para registrarte en eventos";
            header('Location: index.php?controller=auth&action=login');
            exit();
        }
        
        if ($this->eventoModel->registrarAsistencia($id, $_SESSION['user']['id_usuario'])) {
            $_SESSION['success'] = "Te has registrado exitosamente al evento";
        } else {
            $_SESSION['error'] = "Error al registrarse al evento";
        }
        
        header('Location: index.php?controller=evento&action=show&id=' . $id);
        exit();
    }
}
?>