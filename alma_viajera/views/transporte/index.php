<?php 
$titulo = "Transporte";
require_once 'views/layouts/header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-bus"></i> Transporte</h1>
    
    <div>
        <a href="index.php?controller=transporte&action=buscar" class="btn btn-info me-2">
            <i class="fas fa-search"></i> Buscar Rutas
        </a>
        
        <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
            <a href="index.php?controller=transporte&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo Transporte
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <input type="hidden" name="controller" value="transporte">
            <input type="hidden" name="action" value="index">
            
            <div class="col-md-3">
                <select class="form-control" name="tipo">
                    <option value="">Todos los tipos</option>
                    <option value="avion" <?php echo ($_GET['tipo'] ?? '') == 'avion' ? 'selected' : ''; ?>>Avión</option>
                    <option value="tren" <?php echo ($_GET['tipo'] ?? '') == 'tren' ? 'selected' : ''; ?>>Tren</option>
                    <option value="bus" <?php echo ($_GET['tipo'] ?? '') == 'bus' ? 'selected' : ''; ?>>Bus</option>
                    <option value="taxi" <?php echo ($_GET['tipo'] ?? '') == 'taxi' ? 'selected' : ''; ?>>Taxi</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <input type="text" class="form-control" name="origen" placeholder="Origen" 
                       value="<?php echo $_GET['origen'] ?? ''; ?>">
            </div>
            
            <div class="col-md-3">
                <input type="text" class="form-control" name="destino" placeholder="Destino" 
                       value="<?php echo $_GET['destino'] ?? ''; ?>">
            </div>
            
            <div class="col-md-3">
                <input type="date" class="form-control" name="fecha" 
                       value="<?php echo $_GET['fecha'] ?? ''; ?>">
            </div>
            
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="index.php?controller=transporte&action=index" class="btn btn-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Lista de transportes -->
<div class="row">
    <?php if (empty($transportes)): ?>
        <div class="col-12">
            <div class="alert alert-info">No se encontraron opciones de transporte</div>
        </div>
    <?php else: ?>
        <?php foreach ($transportes as $transporte): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="card-title">
                                <i class="fas fa-<?php echo $transporte['tipo'] == 'avion' ? 'plane' : ($transporte['tipo'] == 'tren' ? 'train' : 'bus'); ?>"></i>
                                <?php echo htmlspecialchars($transporte['compania']); ?>
                            </h5>
                            
                            <?php if ($transporte['precio']): ?>
                                <span class="badge bg-success fs-6">
                                    $<?php echo number_format($transporte['precio'], 2); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <p class="mb-1"><strong>Origen:</strong></p>
                                <p><?php echo htmlspecialchars($transporte['origen']); ?></p>
                                <p class="text-muted">
                                    <i class="fas fa-clock"></i> 
                                    <?php echo date('H:i', strtotime($transporte['fecha_hora_salida'])); ?>
                                </p>
                            </div>
                            
                            <div class="col-6">
                                <p class="mb-1"><strong>Destino:</strong></p>
                                <p><?php echo htmlspecialchars($transporte['destino']); ?></p>
                                <?php if ($transporte['fecha_hora_llegada']): ?>
                                    <p class="text-muted">
                                        <i class="fas fa-clock"></i> 
                                        <?php echo date('H:i', strtotime($transporte['fecha_hora_llegada'])); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if ($transporte['numero_vuelo_tren']): ?>
                            <p class="card-text">
                                <strong>Número:</strong> <?php echo htmlspecialchars($transporte['numero_vuelo_tren']); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($transporte['duracion_minutos']): ?>
                            <p class="card-text">
                                <strong>Duración:</strong> <?php echo $transporte['duracion_minutos']; ?> minutos
                            </p>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <a href="index.php?controller=transporte&action=show&id=<?php echo $transporte['id_transporte']; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
                                <a href="index.php?controller=transporte&action=edit&id=<?php echo $transporte['id_transporte']; ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?controller=transporte&action=delete&id=<?php echo $transporte['id_transporte']; ?>" 
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