<?php 
$titulo = "Editar Hotel: " . htmlspecialchars($hotel['nombre']);
require_once 'views/layouts/header.php'; 
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0"><i class="fas fa-edit"></i> Editar Hotel</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=hotel&action=edit&id=<?php echo $hotel['id_hotel']; ?>">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Hotel *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                   value="<?php echo htmlspecialchars($hotel['nombre']); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría (Estrellas)</label>
                            <select class="form-control" id="categoria" name="categoria">
                                <option value="">Seleccionar</option>
                                <option value="1" <?php echo $hotel['categoria'] == 1 ? 'selected' : ''; ?>>1 Estrella</option>
                                <option value="2" <?php echo $hotel['categoria'] == 2 ? 'selected' : ''; ?>>2 Estrellas</option>
                                <option value="3" <?php echo $hotel['categoria'] == 3 ? 'selected' : ''; ?>>3 Estrellas</option>
                                <option value="4" <?php echo $hotel['categoria'] == 4 ? 'selected' : ''; ?>>4 Estrellas</option>
                                <option value="5" <?php echo $hotel['categoria'] == 5 ? 'selected' : ''; ?>>5 Estrellas</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección *</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" required
                               value="<?php echo htmlspecialchars($hotel['direccion']); ?>">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ciudad" class="form-label">Ciudad *</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required
                                   value="<?php echo htmlspecialchars($hotel['ciudad']); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pais" class="form-label">País *</label>
                            <input type="text" class="form-control" id="pais" name="pais" required
                                   value="<?php echo htmlspecialchars($hotel['pais']); ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                                   value="<?php echo htmlspecialchars($hotel['telefono'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?php echo htmlspecialchars($hotel['email'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="sitio_web" class="form-label">Sitio Web</label>
                            <input type="url" class="form-control" id="sitio_web" name="sitio_web"
                                   value="<?php echo htmlspecialchars($hotel['sitio_web'] ?? ''); ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="precio_promedio" class="form-label">Precio Promedio</label>
                            <input type="number" class="form-control" id="precio_promedio" name="precio_promedio" step="0.01"
                                   value="<?php echo htmlspecialchars($hotel['precio_promedio'] ?? ''); ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?php echo htmlspecialchars($hotel['descripcion'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?controller=hotel&action=show&id=<?php echo $hotel['id_hotel']; ?>" 
                           class="btn btn-secondary me-md-2">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Actualizar Hotel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'views/layouts/footer.php'; ?>