<?php
require_once __DIR__ . '/../models/Reseña.php';

class ReseñaController {
    private $reseñaModel;
    
    public function __construct() {
        $this->reseñaModel = new Reseña();
    }
    
    // Crear una nueva reseña
    public function crear() {
        // Verificar que el usuario esté logueado y no sea invitado
        if (!isset($_SESSION['user']) || $_SESSION['user']['tipo'] === 'invitado') {
            $_SESSION['error'] = "Debes estar registrado para dejar reseñas";
            $this->redirectBack();
            exit();
        }
        
        // Procesar creación si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = [
                'id_usuario' => $_SESSION['user']['id_usuario'],
                'tipo_objeto' => $_POST['tipo_objeto'],
                'id_objeto' => $_POST['id_objeto'],
                'calificacion' => $_POST['calificacion'],
                'comentario' => $_POST['comentario']
            ];
            
            if ($this->reseñaModel->crear($datos)) {
                $_SESSION['success'] = "Reseña publicada exitosamente";
            } else {
                $_SESSION['error'] = "Error al publicar la reseña";
            }
            
            // Redirigir a la página del objeto
            $this->redirectToObject($_POST['tipo_objeto'], $_POST['id_objeto']);
        }
    }
    
    // Redirigir a la página anterior
    private function redirectBack() {
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location: index.php?controller=dashboard&action=index');
        }
        exit();
    }
    
    // Redirigir a la página del objeto
    private function redirectToObject($tipo_objeto, $id_objeto) {
        switch ($tipo_objeto) {
            case 'hotel':
                $url = "index.php?controller=hotel&action=show&id=" . $id_objeto;
                break;
            case 'sitio':
                $url = "index.php?controller=sitio&action=show&id=" . $id_objeto;
                break;
            case 'evento':
                $url = "index.php?controller=evento&action=show&id=" . $id_objeto;
                break;
            case 'transporte':
                $url = "index.php?controller=transporte&action=show&id=" . $id_objeto;
                break;
            default:
                $url = "index.php?controller=dashboard&action=index";
        }
        
        header('Location: ' . $url);
        exit();
    }
}
?>