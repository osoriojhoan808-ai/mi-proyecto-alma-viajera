<?php
class HomeController {
    
    // Mostrar página de inicio principal
    public function index() {
        // No requiere autenticación - página pública
        require_once __DIR__ . '/../views/home/index.php';
    }
    
    // Mostrar página "Acerca de"
    public function about() {
        require_once __DIR__ . '/../views/home/about.php';
    }
    
    // Mostrar página de contacto
    public function contact() {
        require_once __DIR__ . '/../views/home/contact.php';
    }
    
    // Mostrar página de ayuda/FAQ
    public function help() {
        require_once __DIR__ . '/../views/home/help.php';
    }
}
?>