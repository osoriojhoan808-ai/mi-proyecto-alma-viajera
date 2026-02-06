<!-- Resto del código... -->

<!-- Sección de reseñas -->
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-star"></i> Reseñas</h5>
    </div>
    <div class="card-body">
        <?php if (empty($reseñas)): ?>
            <p class="text-muted">No hay reseñas para este hotel.</p>
        <?php else: ?>
            <?php foreach ($reseñas as $reseña): ?>
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between mb-2">
                        <strong><?php echo htmlspecialchars($reseña['usuario_nombre']); ?></strong>
                        <span class="text-warning">
                            <?php echo str_repeat('★', $reseña['calificacion']); ?>
                        </span>
                    </div>
                    <p class="mb-1"><?php echo htmlspecialchars($reseña['comentario']); ?></p>
                    <small class="text-muted">
                        <?php echo date('d/m/Y H:i', strtotime($reseña['fecha_reseña'])); ?>
                    </small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] !== 'invitado'): ?>
            <!-- Solo usuarios registrados pueden dejar reseñas -->
            <div class="mt-4">
                <h6>Deja tu reseña</h6>
                <form method="POST" action="index.php?controller=reseña&action=crear">
                    <input type="hidden" name="tipo_objeto" value="hotel">
                    <input type="hidden" name="id_objeto" value="<?php echo $hotel['id_hotel']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Calificación</label>
                        <select class="form-control" name="calificacion" required>
                            <option value="1">1 Estrella</option>
                            <option value="2">2 Estrellas</option>
                            <option value="3">3 Estrellas</option>
                            <option value="4">4 Estrellas</option>
                            <option value="5" selected>5 Estrellas</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Comentario</label>
                        <textarea class="form-control" name="comentario" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Reseña</button>
                </form>
            </div>
        <?php elseif (!isset($_SESSION['user'])): ?>
            <!-- Usuario no logueado -->
            <div class="alert alert-info mt-4">
                <i class="fas fa-info-circle"></i> 
                <a href="index.php?controller=auth&action=login" class="alert-link">Inicia sesión</a> 
                o <a href="index.php?controller=auth&action=register" class="alert-link">regístrate</a> 
                para dejar una reseña.
            </div>
        <?php else: ?>
            <!-- Usuario es invitado -->
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> 
                Los invitados no pueden dejar reseñas. 
                <a href="index.php?controller=auth&action=register" class="alert-link">Regístrate</a> 
                para acceder a todas las funciones.
            </div>
        <?php endif; ?>
    </div>
</div>