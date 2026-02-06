<?php
require_once __DIR__ . '/../models/Transporte.php';
require_once __DIR__ . '/../models/Reseña.php';

class TransporteController {
    private $transporteModel;
    private $reseñaModel;
    
    public function __construct() {
        $this->transporteModel = new Transporte();
        $this->reseñaModel = new Reseña();
    }
    
    // Listar todos los transportes
    public function index() {
        // Obtener filtros
        $filtros = [];
        if (isset($_GET['tipo'])) $filtros['tipo'] = $_GET['tipo'];
        if (isset($_GET['origen'])) $filtros['origen'] = $_GET['origen'];
        if (isset($_GET['destino'])) $filtros['destino'] = $_GET['destino'];
        if (isset($_GET['fecha'])) $filtros['fecha'] = $_GET['fecha'];
        
        $transportes = $this->transporteModel->obtenerTodos($filtros);
        
        require_once __DIR__ . '/../views/transporte/index.php';
    }
    
    // Mostrar un transporte específico
    public function show($id) {
        $transporte = $this->transporteModel->obtenerPorId($id);
        
        if (!$transporte) {
            $_SESSION['error'] = "Transporte no encontrado";
            header('Location: index.php?controller=transporte&action=index');
            exit();
        }
        
        // Obtener reseñas del transporte
        $reseñas = $this->reseñaModel->obtenerPorObjeto('transporte', $id);
        
        require_once __DIR__ . '/../views/transporte/show.php';
    }
    
    // Mostrar formulario para crear transporte
    public function create() {
        // Verificar permisos (solo administradores)
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para crear transportes";
            header('Location: index.php?controller=transporte&action=index');
            exit();
        }
        
        // Procesar creación si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->transporteModel->crear($_POST)) {
                $_SESSION['success'] = "Transporte creado exitosamente";
                header('Location: index.php?controller=transporte&action=index');
                exit();
            } else {
                $_SESSION['error'] = "Error al crear el transporte";
            }
        }
        
        require_once __DIR__ . '/../views/transporte/create.php';
    }
    
    // Mostrar formulario para editar transporte
    public function edit($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para editar transportes";
            header('Location: index.php?controller=transporte&action=index');
            exit();
        }
        
        $transporte = $this->transporteModel->obtenerPorId($id);
        
        if (!$transporte) {
            $_SESSION['error'] = "Transporte no encontrado";
            header('Location: index.php?controller=transporte&action=index');
            exit();
        }
        
        // Procesar actualización si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->transporteModel->actualizar($id, $_POST)) {
                $_SESSION['success'] = "Transporte actualizado exitosamente";
                header('Location: index.php?controller=transporte&action=show&id=' . $id);
                exit();
            } else {
                $_SESSION['error'] = "Error al actualizar el transporte";
            }
        }
        
        require_once __DIR__ . '/../views/transporte/edit.php';
    }
    
    // Eliminar transporte
    public function delete($id) {
        // Verificar permisos
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] !== 'administrador') {
            $_SESSION['error'] = "No tienes permisos para eliminar transportes";
            header('Location: index.php?controller=transporte&action=index');
            exit();
        }
        
        if ($this->transporteModel->eliminar($id)) {
            $_SESSION['success'] = "Transporte eliminado exitosamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el transporte";
        }
        
        header('Location: index.php?controller=transporte&action=index');
        exit();
    }
    
    // Buscar rutas
    public function buscar() {
        // Procesar búsqueda si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $origen = $_POST['origen'] ?? '';
            $destino = $_POST['destino'] ?? '';
            $fecha = $_POST['fecha'] ?? '';
            
            $rutas = $this->transporteModel->buscarRutas($origen, $destino, $fecha);
            
            require_once __DIR__ . '/../views/transporte/resultados.php';
        } else {
            require_once __DIR__ . '/../views/transporte/buscar.php';
        }
    }
}
?>