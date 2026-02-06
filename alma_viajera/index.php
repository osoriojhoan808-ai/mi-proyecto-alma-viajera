<?php
// Iniciar sesión
session_start();

// Autoload básico para modelos y controladores
function autoload($className) {
    $paths = [
        'controllers/' . $className . '.php',
        'models/' . $className . '.php'
    ];
    
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
}

spl_autoload_register('autoload');

// Configuración de base de datos
require_once 'config/database.php';

// Obtener controlador y acción de la URL
$controller = $_GET['controller'] ?? 'home';  // Cambiado a 'home'
$action = $_GET['action'] ?? 'index';

// Lista de controladores permitidos
$allowedControllers = ['auth', 'hotel', 'sitio', 'evento', 'transporte', 'dashboard', 'reseña', 'home'];

if (!in_array($controller, $allowedControllers)) {
    $controller = 'home';  // Cambiado a 'home'
    $action = 'index';
}

// Verificar autenticación para páginas protegidas
$publicControllers = ['auth', 'home'];  // Agregado 'home'
$publicActions = ['login', 'register'];

// Páginas públicas que pueden ver tanto usuarios logueados como invitados
$publicPages = [
    'hotel' => ['index', 'show'],
    'sitio' => ['index', 'show'],
    'evento' => ['index', 'show'],
    'transporte' => ['index', 'show', 'buscar'],
    'home' => ['index', 'about', 'contact', 'help']  // Todas las acciones de home son públicas
];

// Verificar si la página actual es pública
$isPublicPage = false;
if (isset($publicPages[$controller]) && in_array($action, $publicPages[$controller])) {
    $isPublicPage = true;
}

// Si no es página pública y no está autenticado, redirigir al login
if (!$isPublicPage && !in_array($controller, $publicControllers) && !in_array($action, $publicActions)) {
    if (!isset($_SESSION['user'])) {
        $_SESSION['error'] = "Debes iniciar sesión para acceder a esta página";
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
}

// Verificar permisos para acciones restringidas (solo para usuarios registrados, no invitados)
$restrictedActions = [
    'hotel' => ['create', 'edit', 'delete'],
    'sitio' => ['create', 'edit', 'delete'],
    'evento' => ['create', 'edit', 'delete', 'registrar'],
    'transporte' => ['create', 'edit', 'delete']
];

// Si es una acción restringida y el usuario es invitado, mostrar error
if (isset($restrictedActions[$controller]) && in_array($action, $restrictedActions[$controller])) {
    if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'invitado') {
        $_SESSION['error'] = "Los invitados no pueden realizar esta acción. Por favor, regístrate o inicia sesión.";
        header('Location: index.php?controller=' . $controller . '&action=index');
        exit();
    }
}

// Crear instancia del controlador
$controllerClass = ucfirst($controller) . 'Controller';
if (class_exists($controllerClass)) {
    $controllerInstance = new $controllerClass();
    
    // Verificar si la acción existe
    if (method_exists($controllerInstance, $action)) {
        // Pasar parámetros si existen
        if (isset($_GET['id'])) {
            $controllerInstance->$action($_GET['id']);
        } else {
            $controllerInstance->$action();
        }
    } else {
        // Acción no encontrada
        header('HTTP/1.0 404 Not Found');
        require_once 'views/errors/404.php';
        exit();
    }
} else {
    // Controlador no encontrado
    header('HTTP/1.0 404 Not Found');
    require_once 'views/errors/404.php';
    exit();
}
?>