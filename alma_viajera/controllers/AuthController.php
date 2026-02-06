<?php
require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;
    
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }
    
    // Mostrar formulario de login
    public function login() {
        // Si ya está logueado, redirigir al dashboard
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=dashboard&action=index');
            exit();
        }
        
        // Procesar login si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar si es login normal o como invitado
            if (isset($_POST['guest_login'])) {
                // Ingresar como invitado
                $this->loginAsGuest();
            } else {
                // Login normal
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                
                $user = $this->usuarioModel->login($email, $password);
                
                if ($user) {
                    $_SESSION['user'] = $user;
                    $_SESSION['success'] = "¡Bienvenido, " . $user['nombre'] . "!";
                    header('Location: index.php?controller=dashboard&action=index');
                    exit();
                } else {
                    $_SESSION['error'] = "Credenciales incorrectas";
                }
            }
        }
        
        // Mostrar vista de login
        require_once __DIR__ . '/../views/auth/login.php';
    }
    
    // Ingresar como invitado
    private function loginAsGuest() {
        // Crear usuario invitado
        $guestUser = [
            'id_usuario' => 0,
            'nombre' => 'Invitado',
            'email' => 'invitado@almaviajera.com',
            'tipo' => 'invitado',
            'fecha_registro' => date('Y-m-d H:i:s')
        ];
        
        $_SESSION['user'] = $guestUser;
        $_SESSION['info'] = "Has ingresado como invitado. Algunas funciones están limitadas.";
        header('Location: index.php?controller=dashboard&action=index');
        exit();
    }
    
    // Mostrar formulario de registro
    public function register() {
        // Si ya está logueado, redirigir al dashboard
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=dashboard&action=index');
            exit();
        }
        
        // Procesar registro si es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $this->validarRegistro($_POST);
            
            if (empty($errors)) {
                // Verificar que el email no exista
                if ($this->usuarioModel->emailExiste($_POST['email'])) {
                    $_SESSION['error'] = "El email ya está registrado";
                } else {
                    // Crear usuario
                    if ($this->usuarioModel->registrar($_POST)) {
                        $_SESSION['success'] = "¡Registro exitoso! Ahora puedes iniciar sesión.";
                        header('Location: index.php?controller=auth&action=login');
                        exit();
                    } else {
                        $_SESSION['error'] = "Error en el registro";
                    }
                }
            } else {
                $_SESSION['error'] = implode('<br>', $errors);
            }
        }
        
        // Mostrar vista de registro
        require_once __DIR__ . '/../views/auth/register.php';
    }
    
    // Cerrar sesión
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit();
    }
    
    // Validar datos de registro
    private function validarRegistro($datos) {
        $errors = [];
        
        // Validar nombre
        if (empty($datos['nombre']) || strlen(trim($datos['nombre'])) < 3) {
            $errors[] = "El nombre debe tener al menos 3 caracteres";
        }
        
        // Validar email
        if (empty($datos['email']) || !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email inválido";
        }
        
        // Validar contraseña
        if (empty($datos['password']) || strlen($datos['password']) < 6) {
            $errors[] = "La contraseña debe tener al menos 6 caracteres";
        }
        
        // Validar confirmación de contraseña
        if ($datos['password'] !== $datos['confirm_password']) {
            $errors[] = "Las contraseñas no coinciden";
        }
        
        return $errors;
    }
}
?>