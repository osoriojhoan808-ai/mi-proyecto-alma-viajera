<?php
$titulo = "Hoteles";
require_once 'views/layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-hotel"></i> Hoteles</h1>

    <div><a href="index.php?controller=transporte&action=buscar" class="btn btn-info me-2">
            <i class="fas fa-search"></i> Buscar Hotel
        </a>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
            <a href="index.php?controller=hotel&action=create" class="btn btn-success">
                <i class="fas fa-plus"></i> Nuevo Hotel
            </a>
        <?php endif; ?>
    </div>
</div>

<!-- Resto del código permanece igual... -->

<!-- En la lista de hoteles, modificar los botones de acciones -->
<div class="mt-3">
    <a href="index.php?controller=hotel&action=show&id=<?php echo $hotel['id_hotel']; ?>"
        class="btn btn-primary btn-sm">
        <i class="fas fa-eye"></i> Ver Detalles
    </a>

    <?php if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] === 'administrador'): ?>
        <a href="index.php?controller=hotel&action=edit&id=<?php echo $hotel['id_hotel']; ?>"
            class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i>
        </a>
        <a href="index.php?controller=hotel&action=delete&id=<?php echo $hotel['id_hotel']; ?>"
            class="btn btn-danger btn-sm btn-eliminar">
            <i class="fas fa-trash"></i>
        </a>
    <?php endif; ?>
</div>