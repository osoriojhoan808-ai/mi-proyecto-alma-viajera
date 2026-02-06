<?php 
$titulo = "Acerca de Alma Viajera";
require_once 'views/layouts/header.php'; 
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">Acerca de Alma Viajera</h1>
                <p class="lead text-muted">Conoce nuestra historia, misión y visión</p>
            </div>
            
            <!-- Nuestra Historia -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4">Nuestra Historia</h2>
                    <p class="fs-5">
                        Alma Viajera nació en 2024 de la pasión por los viajes y la tecnología. 
                        Un grupo de viajeros experimentados y desarrolladores se unieron con un 
                        objetivo común: simplificar la planificación de viajes para todos.
                    </p>
                    <p class="fs-5">
                        Lo que comenzó como un pequeño proyecto personal se ha convertido en una 
                        plataforma completa que ayuda a miles de viajeros a descubrir el mundo 
                        de manera más inteligente y organizada.
                    </p>
                </div>
            </div>
            
            <!-- Misión y Visión -->
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="fas fa-bullseye fa-3x text-primary"></i>
                            </div>
                            <h3 class="fw-bold text-center mb-3">Nuestra Misión</h3>
                            <p class="text-center">
                                Facilitar la planificación de viajes al proporcionar una plataforma 
                                integral donde los viajeros puedan encontrar, comparar y reservar 
                                todo lo necesario para sus aventuras.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <i class="fas fa-eye fa-3x text-success"></i>
                            </div>
                            <h3 class="fw-bold text-center mb-3">Nuestra Visión</h3>
                            <p class="text-center">
                                Convertirnos en la plataforma de referencia para viajeros de habla 
                                hispana, siendo reconocidos por nuestra confiabilidad, variedad de 
                                opciones y excelente experiencia de usuario.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Valores -->
            <div class="card border-0 shadow-sm mb-5">
                <div class="card-body p-5">
                    <h2 class="fw-bold mb-4 text-center">Nuestros Valores</h2>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-shield-alt fa-2x text-primary"></i>
                                </div>
                                <h5>Confianza</h5>
                                <p class="text-muted small">
                                    Garantizamos información verificada y reseñas auténticas
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-users fa-2x text-success"></i>
                                </div>
                                <h5>Comunidad</h5>
                                <p class="text-muted small">
                                    Creemos en el poder de compartir experiencias entre viajeros
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-lightbulb fa-2x text-warning"></i>
                                </div>
                                <h5>Innovación</h5>
                                <p class="text-muted small">
                                    Constantemente mejoramos nuestra plataforma con nuevas funciones
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-heart fa-2x text-danger"></i>
                                </div>
                                <h5>Pasión</h5>
                                <p class="text-muted small">
                                    Amamos los viajes tanto como nuestros usuarios
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-handshake fa-2x text-info"></i>
                                </div>
                                <h5>Compromiso</h5>
                                <p class="text-muted small">
                                    Nos comprometemos a ofrecer el mejor servicio posible
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="text-center p-3">
                                <div class="mb-3">
                                    <i class="fas fa-globe-americas fa-2x text-secondary"></i>
                                </div>
                                <h5>Sostenibilidad</h5>
                                <p class="text-muted small">
                                    Promovemos el turismo responsable y sostenible
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Equipo -->
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-3">Nuestro Equipo</h2>
                <p class="lead text-muted">Conoce a las personas detrás de Alma Viajera</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 100px;">
                                    <span class="text-white fs-3 fw-bold">AM</span>
                                </div>
                            </div>
                            <h5 class="fw-bold">Ana Martínez</h5>
                            <p class="text-muted small">Fundadora & CEO</p>
                            <p class="small">
                                Viajera con más de 30 países visitados, apasionada por conectar culturas
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 100px;">
                                    <span class="text-white fs-3 fw-bold">CP</span>
                                </div>
                            </div>
                            <h5 class="fw-bold">Carlos Pérez</h5>
                            <p class="text-muted small">CTO</p>
                            <p class="small">
                                Desarrollador con 10+ años de experiencia en plataformas turísticas
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="avatar-lg mx-auto mb-3">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 100px; height: 100px;">
                                    <span class="text-white fs-3 fw-bold">LG</span>
                                </div>
                            </div>
                            <h5 class="fw-bold">Laura González</h5>
                            <p class="text-muted small">Directora de Contenido</p>
                            <p class="small">
                                Periodista especializada en turismo y experta en destinos
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-weight: bold;
    color: white;
    font-size: 1.5rem;
}
</style>

<?php require_once 'views/layouts/footer.php'; ?>