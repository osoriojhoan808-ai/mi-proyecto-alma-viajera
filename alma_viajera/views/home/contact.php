<?php 
$titulo = "Contacto";
require_once 'views/layouts/header.php'; 
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold mb-3">Contáctanos</h1>
                <p class="lead text-muted">¿Tienes preguntas, sugerencias o necesitas ayuda? Estamos aquí para ayudarte</p>
            </div>
            
            <div class="row g-4">
                <!-- Información de contacto -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-envelope fa-2x text-primary"></i>
                            </div>
                            <h5>Email</h5>
                            <p class="text-muted">info@almaviajera.com</p>
                            <a href="mailto:info@almaviajera.com" class="btn btn-outline-primary btn-sm">
                                Enviar Email
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-phone fa-2x text-success"></i>
                            </div>
                            <h5>Teléfono</h5>
                            <p class="text-muted">+1 (555) 123-4567</p>
                            <a href="tel:+15551234567" class="btn btn-outline-success btn-sm">
                                Llamar Ahora
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <i class="fas fa-clock fa-2x text-warning"></i>
                            </div>
                            <h5>Horario</h5>
                            <p class="text-muted">Lun-Vie: 9:00 - 18:00</p>
                            <p class="text-muted">Sáb: 10:00 - 14:00</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de contacto -->
            <div class="card border-0 shadow-sm mt-5">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4">Envíanos un mensaje</h3>
                    
                    <form id="contactForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre Completo *</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="asunto" class="form-label">Asunto *</label>
                                    <select class="form-control" id="asunto" name="asunto" required>
                                        <option value="">Selecciona un asunto</option>
                                        <option value="consulta">Consulta general</option>
                                        <option value="soporte">Soporte técnico</option>
                                        <option value="sugerencia">Sugerencia</option>
                                        <option value="colaboracion">Colaboración</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje *</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            Suscribirme al newsletter para recibir ofertas y novedades
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane"></i> Enviar Mensaje
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- FAQ -->
            <div class="mt-5">
                <h3 class="fw-bold mb-4">Preguntas Frecuentes</h3>
                
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                ¿Es gratuito usar Alma Viajera?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí, Alma Viajera es completamente gratuita para los usuarios. Puedes explorar, 
                                comparar y guardar opciones sin costo alguno.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                ¿Cómo puedo agregar mi negocio a la plataforma?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Si tienes un hotel, sitio turístico, empresa de transporte o organizas eventos, 
                                contáctanos a través del formulario seleccionando "Colaboración" como asunto.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                ¿Cómo puedo reportar información incorrecta?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                En la página de cada elemento encontrarás un botón para "Reportar error". 
                                También puedes contactarnos directamente con los detalles.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Aquí iría la lógica para enviar el formulario
    // Por ahora solo mostramos un mensaje de éxito
    
    alert('¡Mensaje enviado con éxito! Te contactaremos pronto.');
    this.reset();
});
</script>

<?php require_once 'views/layouts/footer.php'; ?>