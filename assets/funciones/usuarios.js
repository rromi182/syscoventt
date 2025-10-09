let tblUsuarios;
document.addEventListener("DOMContentLoaded", function(){
    tblUsuarios = $("#tblUsuarios").DataTable({
        "ajax": {
            "url": BASE_URL + "Usuarios/listar",
            "dataSrc": ""
        },
        "columns": [
            {"data": "id_user"},
            {"data": "username"},
            {
                "data": "foto",
                "render": function(data, type, row) {
                    const ruta = data ? BASE_URL + "assets/img/" + data : BASE_URL + "assets/img/user-photo.png";
                    return `<img src="${ruta}" class="rounded-circle" style="width: 40px; height: 40px;">`;
                },
                "orderable": false,
                "searchable": false
            },
            {"data": "nombre_completo"},
            {"data": "cargo"},
            {"data": "sucursal"},
            {
                "data": "estado",
                "render": function(data) {
                    if (data === 'ACTIVO') {
                        return '<span class="badge badge-success">' + data + '</span>';
                    } else{
                        return '<span class="badge badge-warning">' + data + '</span>';
                    } 
                }
            },
            {
                "data": null, // No usa data del servidor
                "render": function(data, type, row, meta) {
                    return `
                        <button class="btn btn-sm btn-primary edit-user" data-id="${row.id_user}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger delete-user" data-id="${row.id_user}">
                            <i class="fas fa-trash"></i> Eliminar
                    `;
                }
            }
        ],
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "buttons": ["excel", "pdf", "print"],
        "language": {
            "url": "/syscoventt/assets/plugins/datatables/spanish.json"
        }
    });
    initModalEvents()
});


function frmAgregarUsuario(){
    $("#modalAgregarUsuario").modal("show");
    //cargarDatosModal();
}


// Inicializar eventos del modal
function initModalEvents() {
    // Toggle para mostrar/ocultar contraseña
    $('#togglePassword').click(function() {
        togglePasswordVisibility('#password', $(this));
    });

    $('#toggleConfirmPassword').click(function() {
        togglePasswordVisibility('#confirm_password', $(this));
    });

    // Validar coincidencia de contraseñas
    $('#confirm_password').keyup(validatePasswordMatch);

    // Cuando se selecciona un empleado
    $('#id_empleado').change(function() {
        const empleadoId = $(this).val();
        if (empleadoId) {
            cargarInfoEmpleado(empleadoId);
        } else {
            $('#infoEmpleadoCard').hide();
            $('#username').val('');
        }
    });

    // Enviar formulario
    $('#frmAgregarUsuario').submit(function(e) {
        e.preventDefault();
        guardarUsuario();
    });

    // Resetear formulario cuando se cierra el modal
    $('#modalAgregarUsuario').on('hidden.bs.modal', function() {
        resetForm();
    });
}

// Toggle visibilidad de contraseña
function togglePasswordVisibility(fieldId, button) {
    const field = $(fieldId);
    const type = field.attr('type') === 'password' ? 'text' : 'password';
    field.attr('type', type);
    button.find('i').toggleClass('fa-eye fa-eye-slash');
}

// Validar que las contraseñas coincidan
function validatePasswordMatch() {
    const password = $('#password').val();
    const confirmPassword = $('#confirm_password').val();
    const matchDiv = $('#passwordMatch');

    if (confirmPassword === '') {
        matchDiv.html('');
    } else if (password === confirmPassword) {
        matchDiv.html('<small class="text-success"><i class="fas fa-check mr-1"></i>Las contraseñas coinciden</small>');
    } else {
        matchDiv.html('<small class="text-danger"><i class="fas fa-times mr-1"></i>Las contraseñas no coinciden</small>');
    }
}


//EJEMPLO
$(document).ready(function() {
   

    // Toggle para mostrar/ocultar contraseña
    $('#togglePassword').click(function() {
        var passwordField = $('#password');
        var type = passwordField.attr('type') === 'password' ? 'text' : 'password';
        passwordField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    $('#toggleConfirmPassword').click(function() {
        var confirmField = $('#confirm_password');
        var type = confirmField.attr('type') === 'password' ? 'text' : 'password';
        confirmField.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // Validar coincidencia de contraseñas
    $('#confirm_password').keyup(function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        var matchDiv = $('#passwordMatch');

        if (confirmPassword === '') {
            matchDiv.html('');
        } else if (password === confirmPassword) {
            matchDiv.html('<small class="text-success"><i class="fas fa-check mr-1"></i>Las contraseñas coinciden</small>');
        } else {
            matchDiv.html('<small class="text-danger"><i class="fas fa-times mr-1"></i>Las contraseñas no coinciden</small>');
        }
    });

    // Cuando se selecciona un empleado
    $('#id_empleado').change(function() {
        var empleadoId = $(this).val();
        var infoCard = $('#infoEmpleadoCard');

        if (empleadoId) {
            // Simular datos del empleado (aquí iría tu llamada AJAX)
            var empleados = {
                '1': { nombre: 'Romina Almeida', cargo: 'Administrador de Sistemas', email: 'ana.gomez@example.com', sucursal: 'Central' },
                '2': { nombre: 'Jefe de Compras', cargo: 'Jefe de Compras', email: 'carlos.lopez@example.com', sucursal: 'Central' },
                '3': { nombre: 'Auxiliar de Compras', cargo: 'Auxiliar de Compras', email: 'maria.perez@example.com', sucursal: 'Central' },
                '4': { nombre: 'Luz Paredes', cargo: 'Jefe de Ventas', email: 'luzparedes@gmail.com', sucursal: 'Central' }
            };

            if (empleados[empleadoId]) {
                var emp = empleados[empleadoId];
                $('#infoNombre').text(emp.nombre);
                $('#infoCargo').text(emp.cargo);
                $('#infoEmail').text(emp.email);
                $('#infoSucursal').text(emp.sucursal);
                
                infoCard.slideDown();
                
                // Sugerir username
                var usernameSugerido = emp.nombre.toLowerCase().replace(/\s+/g, '.').normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                $('#username').val(usernameSugerido);
            }
        } else {
            infoCard.slideUp();
            $('#username').val('');
        }
    });
});