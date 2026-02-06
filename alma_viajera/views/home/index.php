<?php 
$titulo = "Inicio - Alma Viajera";
require_once 'views/layouts/header.php'; 
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    <img src="public\img\logo2.png" height="120"> Alma Viajera
                </h1>
                <p class="lead mb-4">
                    Tu compañero perfecto para explorar el mundo. Encuentra los mejores hoteles, 
                    descubre sitios increíbles, participa en eventos únicos y planifica tu transporte 
                    de manera fácil y rápida.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <?php if (!isset($_SESSION['user'])): ?>
                    <?php else: ?>
                        <a href="index.php?controller=dashboard&action=index" class="btn btn-light btn-lg">
                            <i class="fas fa-tachometer-alt"></i> Ir al Dashboard
                        </a>
                        <a href="index.php?controller=hotel&action=index" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-hotel"></i> Explorar Hoteles
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="public\img\letrero.png" height="260">
            </div>
        </div>
    </div>
</section>

<!-- Características Principales -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold mb-3">¿Qué ofrece Alma Viajera?</h2>
                <p class="lead text-muted">Todo lo que necesitas para planificar tu próximo viaje en un solo lugar</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-hotel fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Hoteles</h4>
                        <p class="card-text text-muted">
                            Encuentra el alojamiento perfecto según tu presupuesto y preferencias. 
                            Desde hoteles de lujo hasta opciones económicas.
                        </p>
                        <a href="index.php?controller=hotel&action=index" class="btn btn-outline-primary">
                            Ver Hoteles <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-map-marked-alt fa-3x text-success"></i>
                        </div>
                        <h4 class="card-title">Sitios Turísticos</h4>
                        <p class="card-text text-muted">
                            Descubre los lugares más increíbles para visitar. Museos, parques naturales, 
                            monumentos históricos y mucho más.
                        </p>
                        <a href="index.php?controller=sitio&action=index" class="btn btn-outline-success">
                            Ver Sitios <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-calendar-alt fa-3x text-warning"></i>
                        </div>
                        <h4 class="card-title">Eventos</h4>
                        <p class="card-text text-muted">
                            No te pierdas los eventos durante tu estadía. Festivales, conciertos, 
                            ferias y actividades culturales.
                        </p>
                        <a href="index.php?controller=evento&action=index" class="btn btn-outline-warning">
                            Ver Eventos <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100 text-center p-4">
                    <div class="card-body">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-route fa-3x text-info"></i>
                        </div>
                        <h4 class="card-title">Transporte</h4>
                        <p class="card-text text-muted">
                            Planifica tu movilidad fácilmente. Vuelos, trenes, buses y más. 
                            Compara precios y horarios.
                        </p>
                        <a href="index.php?controller=transporte&action=index" class="btn btn-outline-info">
                            Ver Transporte <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cómo Funciona -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">¿Cómo funciona Alma Viajera?</h2>
                <div class="steps">
                    <div class="step mb-4">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h5>Explora</h5>
                            <p class="text-muted mb-0">
                                Navega por nuestro catálogo de hoteles, sitios turísticos, eventos 
                                y opciones de transporte.
                            </p>
                        </div>
                    </div>
                    
                    <div class="step mb-4">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h5>Compara</h5>
                            <p class="text-muted mb-0">
                                Compara precios, ubicaciones, reseñas y características para tomar 
                                la mejor decisión.
                            </p>
                        </div>
                    </div>
                    
                    <div class="step mb-4">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h5>Planifica</h5>
                            <p class="text-muted mb-0">
                                Crea tu itinerario personalizado combinando diferentes opciones 
                                según tus preferencias.
                            </p>
                        </div>
                    </div>
                    
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h5>Disfruta</h5>
                            <p class="text-muted mb-0">
                                Vive la experiencia de viaje perfecta con todo planificado 
                                de antemano.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <img src="https://cdn.pixabay.com/photo/2017/01/18/15/51/paper-1990111_1280.jpg" 
                     alt="Planificación de viaje" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Destinos Populares -->
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Destinos Populares</h2>
                <p class="lead text-muted">Descubre los lugares más visitados por nuestros usuarios</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="destination-card card border-0 overflow-hidden shadow-sm">
                    <img src="https://cdn.pixabay.com/photo/2017/06/29/18/40/background-2455710_1280.jpg" 
                         class="card-img-top" alt="Ciudad de México" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Ciudad de México</h5>
                        <p class="card-text text-muted">
                            La vibrante capital de México ofrece una mezcla única de historia, 
                            cultura y modernidad.
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">15 Hoteles</span>
                            <span class="badge bg-success">25 Sitios</span>
                            <span class="badge bg-warning">10 Eventos</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="destination-card card border-0 overflow-hidden shadow-sm">
                    <img src="https://cdn.pixabay.com/photo/2017/12/16/22/22/barcelona-3023430_1280.jpg" 
                         class="card-img-top" alt="Barcelona" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Barcelona</h5>
                        <p class="card-text text-muted">
                            Ciudad cosmopolita con impresionante arquitectura, playas y 
                            una vibrante vida nocturna.
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">12 Hoteles</span>
                            <span class="badge bg-success">18 Sitios</span>
                            <span class="badge bg-warning">8 Eventos</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="destination-card card border-0 overflow-hidden shadow-sm">
                    <img src="https://cdn.pixabay.com/photo/2014/11/13/23/34/venice-530054_1280.jpg" 
                         class="card-img-top" alt="Venecia" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">Venecia</h5>
                        <p class="card-text text-muted">
                            La ciudad de los canales, un destino romántico lleno de historia 
                            y encanto único.
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-primary">8 Hoteles</span>
                            <span class="badge bg-success">15 Sitios</span>
                            <span class="badge bg-warning">5 Eventos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Lo que dicen nuestros viajeros</h2>
                <p class="lead text-muted">Experiencias reales de usuarios satisfechos</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testimonial card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-3">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">AM</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0">Ana Martínez</h6>
                                <small class="text-muted">Viajera frecuente</small>
                            </div>
                        </div>
                        <p class="card-text">
                            <i class="fas fa-quote-left text-primary me-2"></i>
                            Alma Viajera me ayudó a planificar mi viaje a México de manera perfecta. 
                            Encontré hoteles increíbles y eventos que no conocía.
                            <i class="fas fa-quote-right text-primary ms-2"></i>
                        </p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-3">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">CP</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0">Carlos Pérez</h6>
                                <small class="text-muted">Mochilero</small>
                            </div>
                        </div>
                        <p class="card-text">
                            <i class="fas fa-quote-left text-success me-2"></i>
                            Como viajero con presupuesto limitado, me encanta poder comparar precios 
                            y encontrar las mejores opciones económicas.
                            <i class="fas fa-quote-right text-success ms-2"></i>
                        </p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="testimonial card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar me-3">
                                <div class="bg-warning rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <span class="text-white fw-bold">LG</span>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0">Laura González</h6>
                                <small class="text-muted">Viajera familiar</small>
                            </div>
                        </div>
                        <p class="card-text">
                            <i class="fas fa-quote-left text-warning me-2"></i>
                            Planificar un viaje con niños nunca fue tan fácil. Las reseñas de otros 
                            padres me ayudaron a elegir los mejores lugares familiares.
                            <i class="fas fa-quote-right text-warning ms-2"></i>
                        </p>
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="fw-bold mb-4">¿Listo para tu próxima aventura?</h2>
                <p class="lead mb-4">
                    Únete a miles de viajeros que ya están planificando sus experiencias con Alma Viajera
                </p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <?php if (!isset($_SESSION['user'])): ?>
                        <a href="index.php?controller=auth&action=register" class="btn btn-light btn-lg">
                            <i class="fas fa-rocket"></i> Comenzar Ahora
                        </a>
                        <a href="index.php?controller=auth&action=login" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-user-friends"></i> Explorar como Invitado
                        </a>
                    <?php else: ?>
                        <a href="index.php?controller=hotel&action=index" class="btn btn-light btn-lg">
                            <i class="fas fa-hotel"></i> Buscar Hoteles
                        </a>
                        <a href="index.php?controller=evento&action=index" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-calendar-alt"></i> Ver Eventos
                        </a>
                        <a href="index.php?controller=transporte&action=index" class="btn btn-light btn-lg">
                            <i class="fas fa-route"></i> Planificar Ruta
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
}

.step {
    display: flex;
    align-items: flex-start;
}

.step-number {
    background-color: #0d6efd;
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-right: 15px;
    flex-shrink: 0;
}

.step-content {
    flex: 1;
}

.destination-card {
    transition: transform 0.3s ease;
}

.destination-card:hover {
    transform: translateY(-10px);
}

.testimonial {
    transition: all 0.3s ease;
}

.testimonial:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

.feature-icon {
    transition: transform 0.3s ease;
}

.feature-icon:hover {
    transform: scale(1.1);
}

.avatar {
    flex-shrink: 0;
}
</style>

<?php require_once 'views/layouts/footer.php'; ?>