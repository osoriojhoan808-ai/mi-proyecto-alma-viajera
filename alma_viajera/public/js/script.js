// Funciones generales para Alma Viajera

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips de Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Inicializar popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    // Validación de formularios
    var forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    
    // Confirmación para eliminaciones
    var deleteButtons = document.querySelectorAll('.btn-eliminar');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
                e.preventDefault();
            }
        });
    });
    
    // Toggle para mostrar/ocultar contraseñas
    var togglePasswordButtons = document.querySelectorAll('.toggle-password');
    togglePasswordButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.previousElementSibling;
            var icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Validar que las contraseñas coincidan
    var password = document.getElementById('password');
    var confirmPassword = document.getElementById('confirm_password');
    
    if (password && confirmPassword) {
        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Las contraseñas no coinciden');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
        
        password.onchange = validatePassword;
        confirmPassword.onkeyup = validatePassword;
    }
    
    // Formatear números con separadores de miles
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
    
    // Actualizar precios formateados
    var priceElements = document.querySelectorAll('.price');
    priceElements.forEach(function(element) {
        var price = parseFloat(element.textContent.replace(/[^0-9.-]+/g, ""));
        if (!isNaN(price)) {
            element.textContent = '$' + formatNumber(price.toFixed(2));
        }
    });
    
    // Función para filtrar tablas
    var searchInputs = document.querySelectorAll('.table-search');
    searchInputs.forEach(function(input) {
        input.addEventListener('keyup', function() {
            var filter = this.value.toLowerCase();
            var table = this.closest('.table-responsive').querySelector('table');
            var rows = table.getElementsByTagName('tr');
            
            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var cells = row.getElementsByTagName('td');
                var found = false;
                
                for (var j = 0; j < cells.length; j++) {
                    var cell = cells[j];
                    if (cell) {
                        if (cell.textContent.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    });
    
    // Función para ordenar tablas
    var sortableHeaders = document.querySelectorAll('.sortable');
    sortableHeaders.forEach(function(header) {
        header.addEventListener('click', function() {
            var table = this.closest('table');
            var column = this.cellIndex;
            var rows = Array.from(table.rows).slice(1);
            var isAscending = !this.classList.contains('asc');
            
            rows.sort(function(a, b) {
                var aVal = a.cells[column].textContent.trim();
                var bVal = b.cells[column].textContent.trim();
                
                if (!isNaN(aVal) && !isNaN(bVal)) {
                    return isAscending ? aVal - bVal : bVal - aVal;
                }
                
                return isAscending ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
            });
            
            // Reordenar filas
            var tbody = table.querySelector('tbody');
            rows.forEach(function(row) {
                tbody.appendChild(row);
            });
            
            // Actualizar indicadores de orden
            sortableHeaders.forEach(function(h) {
                h.classList.remove('asc', 'desc');
            });
            
            this.classList.add(isAscending ? 'asc' : 'desc');
        });
    });
    
    // Animación de carga para botones
    var submitButtons = document.querySelectorAll('button[type="submit"]');
    submitButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            if (this.form && this.form.checkValidity()) {
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...';
                this.disabled = true;
            }
        });
    });
    
    // Auto-completar fecha actual en campos de fecha
    var dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(function(input) {
        if (!input.value) {
            var today = new Date().toISOString().split('T')[0];
            input.value = today;
        }
    });
    
    // Validar fechas futuras
    var futureDateInputs = document.querySelectorAll('input[data-future-date]');
    futureDateInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var selectedDate = new Date(this.value);
            var today = new Date();
            
            if (selectedDate < today) {
                alert('La fecha debe ser futura');
                this.value = '';
            }
        });
    });
    
    // Contador de caracteres para textareas
    var textareas = document.querySelectorAll('textarea[data-maxlength]');
    textareas.forEach(function(textarea) {
        var maxLength = textarea.getAttribute('data-maxlength');
        var counter = document.createElement('div');
        counter.className = 'text-muted small mt-1';
        counter.textContent = '0/' + maxLength + ' caracteres';
        
        textarea.parentNode.appendChild(counter);
        
        textarea.addEventListener('input', function() {
            var length = this.value.length;
            counter.textContent = length + '/' + maxLength + ' caracteres';
            
            if (length > maxLength) {
                counter.classList.add('text-danger');
                this.classList.add('is-invalid');
            } else {
                counter.classList.remove('text-danger');
                this.classList.remove('is-invalid');
            }
        });
    });
    
    // Smooth scroll para enlaces internos
    var internalLinks = document.querySelectorAll('a[href^="#"]');
    internalLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href');
            if (targetId !== '#') {
                e.preventDefault();
                var targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

// Funciones globales
function showAlert(message, type = 'success') {
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-' + type + ' alert-dismissible fade show';
    alertDiv.role = 'alert';
    alertDiv.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    
    var container = document.querySelector('.container');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
        
        // Auto-remover después de 5 segundos
        setTimeout(function() {
            if (alertDiv.parentNode) {
                alertDiv.parentNode.removeChild(alertDiv);
            }
        }, 5000);
    }
}

function confirmAction(message) {
    return confirm(message);
}

function formatDate(dateString) {
    var date = new Date(dateString);
    return date.toLocaleDateString('es-ES', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatCurrency(amount) {
    return '$' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// API helper functions
async function fetchData(url, options = {}) {
    try {
        const response = await fetch(url, options);
        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        showAlert('Error al cargar los datos', 'danger');
        return null;
    }
}

// Local storage helper
const Storage = {
    set: function(key, value) {
        try {
            localStorage.setItem(key, JSON.stringify(value));
            return true;
        } catch (error) {
            console.error('Error al guardar en localStorage:', error);
            return false;
        }
    },
    
    get: function(key) {
        try {
            const item = localStorage.getItem(key);
            return item ? JSON.parse(item) : null;
        } catch (error) {
            console.error('Error al leer de localStorage:', error);
            return null;
        }
    },
    
    remove: function(key) {
        try {
            localStorage.removeItem(key);
            return true;
        } catch (error) {
            console.error('Error al eliminar de localStorage:', error);
            return false;
        }
    },
    
    clear: function() {
        try {
            localStorage.clear();
            return true;
        } catch (error) {
            console.error('Error al limpiar localStorage:', error);
            return false;
        }
    }
};