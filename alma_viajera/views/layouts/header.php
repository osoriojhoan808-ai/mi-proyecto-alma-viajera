<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alma Viajera - <?php echo $titulo ?? 'Tu Compañero de Viaje'; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="public/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" href="public/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class=""></i> Alma Viajera
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=index">
                            <i class="fas fa-home"></i> Inicio
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="explorarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-compass"></i> Explorar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controller=hotel&action=index">
                                <i class="fas fa-hotel"></i> Hoteles
                            </a></li>
                            <li><a class="dropdown-item" href="index.php?controller=sitio&action=index">
                                <i class="fas fa-map-marker-alt"></i> Sitios Turísticos
                            </a></li>
                            <li><a class="dropdown-item" href="index.php?controller=evento&action=index">
                                <i class="fas fa-calendar-alt"></i> Eventos
                            </a></li>
                            <li><a class="dropdown-item" href="index.php?controller=transporte&action=index">
                                <i class="fas fa-bus"></i> Transporte
                            </a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=about">
                            <i class="fas fa-info-circle"></i> Acerca de
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=contact">
                            <i class="fas fa-envelope"></i> Contacto
                        </a>
                    </li>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] !== 'invitado'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=dashboard&action=index">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> 
                                <?php 
                                echo htmlspecialchars($_SESSION['user']['nombre']);
                                if ($_SESSION['user']['tipo'] === 'invitado') {
                                    echo ' <span class="badge bg-warning">Invitado</span>';
                                }
                                ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if ($_SESSION['user']['tipo'] !== 'invitado'): ?>
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-user-circle"></i> Mi Perfil
                                    </a></li>
                                    <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-cog"></i> Configuración
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="index.php?controller=auth&action=logout">
                                    <i class="fas fa-sign-out-alt"></i> 
                                    <?php echo $_SESSION['user']['tipo'] === 'invitado' ? 'Salir' : 'Cerrar Sesión'; ?>
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=login">
                                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=auth&action=register">
                                <i class="fas fa-user-plus"></i> Registrarse
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Espacio para la navbar fija -->
    <div style="height: 76px;"></div>

    <!-- Contenedor principal -->
    <div class="container mt-4">
        <!-- Mensajes de alerta -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['success']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['error']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['info'])): ?>
            <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['info']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['info']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['warning'])): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                <?php echo $_SESSION['warning']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['warning']); ?>
        <?php endif; ?>