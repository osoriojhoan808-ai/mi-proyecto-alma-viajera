<?php 
$titulo = "Eventos";
require_once 'views/layouts/header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-calendar-alt"></i> Eventos</h1>
    
    <?php if (isset($_SESSION['user']) && ($_SESSION['user']['tipo'] === 'administrador' || $_SESSION['user']['tipo'] === 'guia')): ?>
        <a href="index.php?controller=evento&action=create" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Evento
        </a>
    <?php endif; ?>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <input type="hidden" name="controller" value="evento">
            <input type="hidden" name="action" value="index">
            
            <div class="col-md-4">
                <select class="form-control" name="tipo">
                    <option value="">Todos los tipos</option>
                    <option value="festival" <?php echo ($_GET['tipo'] ?? '') == 'festival' ? 'selected' : ''; ?>>Festival</option>
                    <option value="concierto" <?php echo ($_GET['tipo'] ?? '') == 'concierto' ? 'selected' : ''; ?>>Concierto</option>
                    <option value="feria" <?php echo ($_GET['tipo'] ?? '') == 'feria' ? 'selected' : ''; ?>>Feria</option>
                    <option value="deportivo" <?php echo ($_GET['tipo'] ?? '') == 'deportivo' ? 'selected' : ''; ?>>Deportivo</option>
                </select>
            </div>
            
            <div class="col-md-4">
                <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" 
                       value="<?php echo $_GET['ciudad'] ?? ''; ?>">
            </div>
            
            <div class="col-md-4">
                <input type="date" class="form-control" name="fecha_desde" 
                       value="<?php echo $_GET['fecha_desde'] ?? ''; ?>">
            </div>
            
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="index.php?controller=evento&action=index" class="btn btn-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Lista de eventos -->
<div class="row">
    <?php if (empty($eventos)): ?>
        <div class="col-12">
            <div class="alert alert-info">No se encontraron eventos</div>
        </div>
    <?php else: ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($evento['titulo']); ?></h5>
                        
                        <div class="mb-2">
                            <span class="badge bg-info">
                                <?php echo ucfirst(htmlspecialchars($evento['tipo'])); ?>
                            </span>
                            
                            <?php if ($evento['precio']): ?>
                                <span class="badge bg-success">
                                    $<?php echo number_format($evento['precio'], 2); ?>
                                </span>
                            <?php else: ?>
                                <span class="badge bg-success">Gratis</span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php echo htmlspecialchars($evento['ciudad'] . ', ' . $evento['pais']); ?>
                        </p>
                        
                        <p class="card-text">
                            <i class="fas fa-calendar"></i> 
                            <?php echo date('d/m/Y H:i', strtotime($evento['fecha_inicio'])); ?>
                        </p>
                        
                        <?php if ($evento['descripcion']): ?>
                            <p class="card-text text-muted">
                                <?php echo substr(htmlspecialchars($evento['descripcion']), 0, 100); ?>...
                            </p>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <a href="index.php?controller=evento&action=show&id=<?php echo $evento['id_evento']; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            
                            <?php if (isset($_SESSION['user']) && ($_SESSION['user']['tipo'] === 'administrador' || $_SESSION['user']['tipo'] === 'guia')): ?>
                                <a href="index.php?controller=evento&action=edit&id=<?php echo $evento['id_evento']; ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?controller=evento&action=delete&id=<?php echo $evento['id_evento']; ?>" 
                                   class="btn btn-danger btn-sm btn-eliminar">
                                    <i class="fas fa-trash"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once 'views/layouts/footer.php'; ?>