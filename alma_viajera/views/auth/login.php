<?php 
$titulo = "Iniciar Sesión";
require_once 'views/layouts/header.php'; 
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</h4>
            </div>
            <div class="card-body">
                <!-- Botón para ingresar como invitado -->
                <div class="text-center mb-4">
                    <form method="POST" action="index.php?controller=auth&action=login">
                        <input type="hidden" name="guest_login" value="1">
                        <button type="submit" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-user-friends"></i> Ingresar como Invitado
                        </button>
                    </form>
                    <p class="text-muted mt-2 small">
                        Podrás explorar el sistema con funciones limitadas
                    </p>
                </div>
                
                <hr>
                
                <p class="text-center mb-4">O ingresa con tu cuenta</p>
                
                <form method="POST" action="index.php?controller=auth&action=login">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   value="<?php echo $_POST['email'] ?? ''; ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </button>
                    </div>
                </form>
                
                <div class="text-center mt-3">
                    <p>¿No tienes cuenta? <a href="index.php?controller=auth&action=register">Regístrate aquí</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>

<?php require_once 'views/layouts/footer.php'; ?>