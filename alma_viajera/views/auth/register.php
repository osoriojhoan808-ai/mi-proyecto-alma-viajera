<?php 
$titulo = "Registro";
require_once 'views/layouts/header.php'; 
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0"><i class="fas fa-user-plus"></i> Crear Cuenta</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?controller=auth&action=register">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                   value="<?php echo $_POST['nombre'] ?? ''; ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                   value="<?php echo $_POST['email'] ?? ''; ?>">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Mínimo 6 caracteres</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Contraseña *</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono"
                                   value="<?php echo $_POST['telefono'] ?? ''; ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pais" class="form-label">País</label>
                            <select class="form-control" id="pais" name="pais">
                                <option value="">Seleccionar país</option>
                                <option value="México" <?php echo ($_POST['pais'] ?? '') == 'México' ? 'selected' : ''; ?>>México</option>
                                <option value="España" <?php echo ($_POST['pais'] ?? '') == 'España' ? 'selected' : ''; ?>>España</option>
                                <option value="Argentina" <?php echo ($_POST['pais'] ?? '') == 'Argentina' ? 'selected' : ''; ?>>Argentina</option>
                                <option value="Colombia" <?php echo ($_POST['pais'] ?? '') == 'Colombia' ? 'selected' : ''; ?>>Colombia</option>
                                <option value="Chile" <?php echo ($_POST['pais'] ?? '') == 'Chile' ? 'selected' : ''; ?>>Chile</option>
                                <option value="Perú" <?php echo ($_POST['pais'] ?? '') == 'Perú' ? 'selected' : ''; ?>>Perú</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                               value="<?php echo $_POST['fecha_nacimiento'] ?? ''; ?>">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-user-check"></i> Registrarse
                        </button>
                        <a href="index.php?controller=auth&action=login" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle para mostrar/ocultar contraseñas
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    const confirmInput = document.getElementById('confirm_password');
    const icon = this.querySelector('i');
    
    if (confirmInput.type === 'password') {
        confirmInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        confirmInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>

<?php require_once 'views/layouts/footer.php'; ?>