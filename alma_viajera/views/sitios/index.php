<?php 
$titulo = "Sitios Turísticos";
require_once 'views/layouts/header.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-map-marker-alt"></i> Sitios Turísticos</h1>
    
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
        <a href="index.php?controller=sitio&action=create" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Sitio
        </a>
    <?php endif; ?>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <input type="hidden" name="controller" value="sitio">
            <input type="hidden" name="action" value="index">
            
            <div class="col-md-4">
                <select class="form-control" name="tipo">
                    <option value="">Todos los tipos</option>
                    <option value="cultural" <?php echo ($_GET['tipo'] ?? '') == 'cultural' ? 'selected' : ''; ?>>Cultural</option>
                    <option value="natural" <?php echo ($_GET['tipo'] ?? '') == 'natural' ? 'selected' : ''; ?>>Natural</option>
                    <option value="historico" <?php echo ($_GET['tipo'] ?? '') == 'historico' ? 'selected' : ''; ?>>Histórico</option>
                    <option value="religioso" <?php echo ($_GET['tipo'] ?? '') == 'religioso' ? 'selected' : ''; ?>>Religioso</option>
                </select>
            </div>
            
            <div class="col-md-4">
                <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" 
                       value="<?php echo $_GET['ciudad'] ?? ''; ?>">
            </div>
            
            <div class="col-md-4">
                <input type="text" class="form-control" name="pais" placeholder="País" 
                       value="<?php echo $_GET['pais'] ?? ''; ?>">
            </div>
            
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Filtrar</button>
                <a href="index.php?controller=sitio&action=index" class="btn btn-secondary">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<!-- Lista de sitios -->
<div class="row">
    <?php if (empty($sitios)): ?>
        <div class="col-12">
            <div class="alert alert-info">No se encontraron sitios turísticos</div>
        </div>
    <?php else: ?>
        <?php foreach ($sitios as $sitio): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($sitio['nombre']); ?></h5>
                        
                        <div class="mb-2">
                            <span class="badge bg-info">
                                <?php echo ucfirst(htmlspecialchars($sitio['tipo'])); ?>
                            </span>
                            
                            <?php if ($sitio['precio_entrada']): ?>
                                <span class="badge bg-success">
                                    $<?php echo number_format($sitio['precio_entrada'], 2); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt"></i> 
                            <?php echo htmlspecialchars($sitio['ciudad'] . ', ' . $sitio['pais']); ?>
                        </p>
                        
                        <?php if ($sitio['horario_apertura'] && $sitio['horario_cierre']): ?>
                            <p class="card-text">
                                <i class="fas fa-clock"></i> 
                                <?php echo date('H:i', strtotime($sitio['horario_apertura'])); ?> - 
                                <?php echo date('H:i', strtotime($sitio['horario_cierre'])); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($sitio['descripcion']): ?>
                            <p class="card-text text-muted">
                                <?php echo substr(htmlspecialchars($sitio['descripcion']), 0, 100); ?>...
                            </p>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <a href="index.php?controller=sitio&action=show&id=<?php echo $sitio['id_sitio']; ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Ver Detalles
                            </a>
                            
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
                                <a href="index.php?controller=sitio&action=edit&id=<?php echo $sitio['id_sitio']; ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="index.php?controller=sitio&action=delete&id=<?php echo $sitio['id_sitio']; ?>" 
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