<?php 
$titulo = "Dashboard";
require_once 'views/layouts/header.php'; 
?>

<div class="row">
    <div class="col-12">
        <h1 class="mb-4">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </h1>
        
        <div class="row">
            <!-- Estadísticas -->
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Hoteles</h6>
                                <h2 class="mb-0">15</h2>
                            </div>
                            <i class="fas fa-hotel fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Sitios</h6>
                                <h2 class="mb-0">28</h2>
                            </div>
                            <i class="fas fa-map-marker-alt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Eventos</h6>
                                <h2 class="mb-0">12</h2>
                            </div>
                            <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="card border-0 bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title">Transporte</h6>
                                <h2 class="mb-0">8</h2>
                            </div>
                            <i class="fas fa-bus fa-2x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Acciones Rápidas -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Acciones Rápidas</h5>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <a href="index.php?controller=hotel&action=create" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-plus"></i> Nuevo Hotel
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="index.php?controller=sitio&action=create" class="btn btn-outline-success w-100">
                                    <i class="fas fa-plus"></i> Nuevo Sitio
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="index.php?controller=evento&action=create" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-plus"></i> Nuevo Evento
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="index.php?controller=transporte&action=create" class="btn btn-outline-info w-100">
                                    <i class="fas fa-plus"></i> Nuevo Transporte
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Últimas Actividades -->
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Últimos Hoteles</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Hotel Plaza Central</h6>
                                    <small>Hace 2 días</small>
                                </div>
                                <p class="mb-1 small text-muted">Ciudad de México</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Gran Hotel del Norte</h6>
                                    <small>Hace 3 días</small>
                                </div>
                                <p class="mb-1 small text-muted">Guadalajara</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Próximos Eventos</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Festival de Primavera</h6>
                                    <small>20 Mar</small>
                                </div>
                                <p class="mb-1 small text-muted">Ciudad de México</p>
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Concierto de Rock</h6>
                                    <small>15 Abr</small>
                                </div>
                                <p class="mb-1 small text-muted">Guadalajara</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>