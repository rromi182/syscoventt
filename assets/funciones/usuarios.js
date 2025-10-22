let tblUsuarios;

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    tblUsuarios = $("#tblUsuarios").DataTable({
        "ajax": {
            "url": BASE_URL + "Usuarios/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_user" },
            { "data": "username" },
            {
                "data": "foto",
                "render": function (data, type, row) {
                    const ruta = data ? BASE_URL + "assets/img/" + data : BASE_URL + "assets/img/user-photo.png";
                    return `<img src="${ruta}" class="rounded-circle" style="width: 40px; height: 40px;">`;
                },
                "orderable": false,
                "searchable": false
            },
            { "data": "nombre_completo" },
            { "data": "cargo" },
            { "data": "sucursal" },
            {
                "data": "estado",
                "render": function (data) {
                    if (data === 'ACTIVO') {
                        return '<span class="badge badge-success">' + data + '</span>';
                    } else {
                        return '<span class="badge badge-warning">' + data + '</span>';
                    }
                }
            },
            {
                "data": null,
                "render": function (data, type, row, meta) {
                    const isActive = row.estado === 'ACTIVO';
                    const btnDesactivarDisabled = isActive ? '' : 'disabled';
                    const btnActivarDisabled = !isActive ? '' : 'disabled';

                    return `
            <button class="btn btn-sm btn-primary" 
                    data-toggle="tooltip" 
                    title="Editar Usuario" 
                    onclick="editarUsuario(${row.id_user})">
                <i class="fas fa-edit"></i>
            </button>
            
            <button class="btn btn-sm btn-danger" 
                    data-toggle="tooltip" 
                    title="Eliminar Usuario" 
                    onclick="eliminarUsuario(${row.id_user})"
                    ${btnDesactivarDisabled}>
                <i class="fas fa-ban"></i>
            </button>
            
            <button class="btn btn-sm btn-success" 
                    data-toggle="tooltip" 
                    title="Activar Usuario" 
                    onclick="activarUsuario(${row.id_user})"
                    ${btnActivarDisabled}>
                <i class="fas fa-check"></i>
            </button>
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

    $('#foto').on('change', function () {
        const file = this.files[0];
        if (file) {
            // Validar tipo de archivo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no válido',
                    text: 'Solo se permiten archivos JPG, JPEG o PNG',
                    confirmButtonText: 'Entendido'
                });
                $(this).val('');
                return;
            }

            // Validar tamaño (2MB = 2 * 1024 * 1024)
            if (file.size > 2 * 1024 * 1024) {
                Swal.fire({
                    icon: 'error',
                    title: 'Archivo muy grande',
                    text: 'La imagen no debe superar los 2MB',
                    confirmButtonText: 'Entendido'
                });
                $(this).val('');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImgUsuario').attr('src', e.target.result);
                $('#vistaPreviaFotoUsuario').show();
            }
            reader.readAsDataURL(file);

            // Mostrar nombre del archivo
            $('.custom-file-label').text(file.name);
        } else {
            $('#vistaPreviaFotoUsuario').hide();
            $('.custom-file-label').text('Seleccionar archivo');
        }
    });

    // Inicializar eventos
    initModalEvents();
});

// Función para abrir el modal
function frmAgregarUsuario() {
    document.getElementById("titleModal").textContent = "Agregar Nuevo Usuario";
    $("#modalAgregarUsuario").modal("show");
    resetForm();
}

// Función principal para agregar usuario
function agregarUsuario(e) {

    e.preventDefault();

    // Obtener todos los campos del formulario
    const empleadoInput = document.getElementById("id_empleado");
    const sucursalInput = document.getElementById("id_sucursal");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");


    // Obtener valores
    const empleado = empleadoInput.value.trim();
    const sucursal = sucursalInput.value.trim();
    const username = usernameInput.value.trim();
    const password = passwordInput.value.trim();
    const confirmPassword = confirmPasswordInput.value.trim();

    // Remover clases de error previas
    empleadoInput.classList.remove("is-invalid");
    sucursalInput.classList.remove("is-invalid");
    usernameInput.classList.remove("is-invalid");
    passwordInput.classList.remove("is-invalid");
    confirmPasswordInput.classList.remove("is-invalid");

    // Validar campos vacíos
    if (empleado === "" || sucursal === "" || username === "" || password === "" || confirmPassword === "") {
        let camposVacios = [];

        if (empleado === "") {
            empleadoInput.classList.add("is-invalid");
            camposVacios.push("Empleado");
        }
        if (sucursal === "") {
            sucursalInput.classList.add("is-invalid");
            camposVacios.push("Sucursal");
        }
        if (username === "") {
            usernameInput.classList.add("is-invalid");
            camposVacios.push("Nombre de Usuario");
        }
        if (password === "") {
            passwordInput.classList.add("is-invalid");
            camposVacios.push("Contraseña");
        }
        if (confirmPassword === "") {
            confirmPasswordInput.classList.add("is-invalid");
            camposVacios.push("Confirmar Contraseña");
        }

        Swal.fire({
            icon: 'warning',
            title: 'Campos requeridos',
            text: 'Los siguientes campos son obligatorios: ' + camposVacios.join(', '),
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false,
            showConfirmButton: true
        });

        // Enfocar el primer campo vacío
        if (empleado === "") empleadoInput.focus();
        else if (sucursal === "") sucursalInput.focus();
        else if (username === "") usernameInput.focus();
        else if (password === "") passwordInput.focus();
        else confirmPasswordInput.focus();

        return;
    }

    // Validar que las contraseñas coincidan
    if (password !== confirmPassword) {
        passwordInput.classList.add("is-invalid");
        confirmPasswordInput.classList.add("is-invalid");

        Swal.fire({
            icon: 'error',
            title: 'Contraseñas no coinciden',
            text: 'La contraseña y la confirmación deben ser iguales.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });

        passwordInput.focus();
        return;
    }

    // Validar longitud mínima de contraseña
    if (password.length < 6) {
        passwordInput.classList.add("is-invalid");
        confirmPasswordInput.classList.add("is-invalid");

        Swal.fire({
            icon: 'warning',
            title: 'Contraseña muy corta',
            text: 'La contraseña debe tener al menos 6 caracteres.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });

        passwordInput.focus();
        return;
    }

    // VERIFICAR USERNAME ANTES DE ENVIAR
    verificarUsername(username, function (existe) {
        if (existe) {
            Swal.fire({
                icon: 'error',
                title: 'Usuario no disponible',
                text: 'El nombre de usuario "' + username + '" ya está en uso. Por favor elige otro.',
                confirmButtonText: 'Entendido',
                scrollbarPadding: false,
                heightAuto: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // SOLUCIÓN: Esperar a que el modal de SweetAlert se cierre completamente
                    setTimeout(() => {
                        usernameInput.classList.add("is-invalid");
                        usernameInput.focus();
                        usernameInput.select();
                    }, 300);
                }
            });
            return;
        }


        // Si todas las validaciones pasan, enviar el formulario
        const url = BASE_URL + "Usuarios/agregar";
        const form = document.getElementById("frmAgregarUsuario");
        const http = new XMLHttpRequest();

        http.open("POST", url, true);
        http.send(new FormData(form));

        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                console.log(http.responseText);

                const response = JSON.parse(http.responseText);

                if (response == "Success") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Usuario agregado!',
                        text: 'El usuario ha sido registrado exitosamente.',
                        timer: 2000,
                        showConfirmButton: false,
                        scrollbarPadding: false,
                        heightAuto: false
                    }).then(() => {
                        resetForm();
                        $('#modalAgregarUsuario').modal('hide');
                        // Recargar la tabla
                        tblUsuarios.ajax.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al crear usuario',
                        text: response,
                        confirmButtonText: 'Intentar nuevamente',
                        scrollbarPadding: false,
                        heightAuto: false
                    });
                }
            }
        };
    });
}

//Pendiente terminar
function editarUsuario(id_user) {
    document.getElementById("titleModal").textContent = "Editar Usuario";
    //console.log(id_user);

    const url = BASE_URL + "Usuarios/editar/" + id_user;
    const http = new XMLHttpRequest();

    http.open("GET", url, true);
    http.send();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            const response = JSON.parse(http.responseText);
            // Obtener todos los campos del formulario
            empleadoInput = document.getElementById("id_empleado").value = response.id_empleado;
            sucursalInput = document.getElementById("id_sucursal").value = response.id_sucursal;
            usernameInput = document.getElementById("username").value = response.username;
            fotoInput = document.getElementById("foto").value = response.foto;
        }
    };
    $("#modalAgregarUsuario").modal("show");
}

function eliminarUsuario(id_user) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "El usuario no se eliminará pero será desactivado y no podrá acceder al sistema",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = BASE_URL + "Usuarios/eliminar/" + id_user;
            const http = new XMLHttpRequest();

            http.open("GET", url, true);
            http.send();

            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    const response = JSON.parse(http.responseText);

                    if (response == "Success") {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Usuario eliminado!',
                            text: 'El usuario ha sido eliminado correctamente.',
                            timer: 2000,
                            showConfirmButton: false,
                            scrollbarPadding: false,
                            heightAuto: false
                        }).then(() => {
                            // Recargar la tabla
                            tblUsuarios.ajax.reload();

                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al eliminar usuario',
                            text: response,
                            confirmButtonText: 'Intentar nuevamente',
                            scrollbarPadding: false,
                            heightAuto: false
                        });
                    }
                }
            };
        }
    });
}

function activarUsuario(id_user) {
    console.log("ID USUARIO: " + id_user);
    Swal.fire({
        title: "¿Estás seguro?",
        text: "El usuario no se eliminará pero será desactivado y no podrá acceder al sistema",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí!",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const url = BASE_URL + "Usuarios/activar/" + id_user;
            const http = new XMLHttpRequest();

            http.open("GET", url, true);
            http.send();

            http.onreadystatechange = function () {
                if (http.readyState == 4 && http.status == 200) {
                    const response = JSON.parse(http.responseText);

                    if (response == "Success") {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Usuario activado!',
                            text: 'El usuario ha sido activado correctamente.',
                            timer: 2000,
                            showConfirmButton: false,
                            scrollbarPadding: false,
                            heightAuto: false
                        }).then(() => {
                            // Recargar la tabla
                            tblUsuarios.ajax.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error al activar usuario',
                            text: response,
                            confirmButtonText: 'Intentar nuevamente',
                            scrollbarPadding: false,
                            heightAuto: false
                        });
                    }


                }
            };
        }
    });
}

// Inicializar eventos del modal
function initModalEvents() {

    // Inicializar Select2
    $('#id_empleado').select2({
        theme: 'bootstrap-5',
        placeholder: 'Seleccionar empleado',
        allowClear: true,
        width: '100%'
    });

    $('#id_sucursal').select2({
        theme: 'bootstrap-5',
        placeholder: 'Seleccionar sucursal',
        allowClear: true,
        width: '100%'
    });

    // Toggle para mostrar/ocultar contraseña
    $('#togglePassword').click(function () {
        togglePasswordVisibility('#password', $(this));
    });

    $('#toggleConfirmPassword').click(function () {
        togglePasswordVisibility('#confirm_password', $(this));
    });

    // Validar coincidencia de contraseñas
    $('#confirm_password').keyup(validatePasswordMatch);

    // Cuando se selecciona un empleado
    $('#id_empleado').change(function () {
        const empleadoId = $(this).val();
        if (empleadoId) {
            cargarInfoEmpleado(empleadoId);
        } else {
            $('#infoEmpleadoCard').hide();
            $('#username').val('');
        }
    });

    //initUsernameValidation();

    // Enviar formulario - ESTA ES LA LÍNEA IMPORTANTE
    $('#frmAgregarUsuario').off('submit').on('submit', function (e) {
        agregarUsuario(e);
    });

    // Resetear formulario cuando se cierra el modal
    $('#modalAgregarUsuario').on('hidden.bs.modal', function () {
        resetForm();
    });
}

// Verificar si el username ya existe
function verificarUsername(username, callback) {
    if (!username || username.trim() === '') {
        callback(false);
        return;
    }

    const url = BASE_URL + "Usuarios/verificarUsername";

    $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: { username: username },
        success: function (response) {
            callback(response.existe);
        },
        error: function (xhr, status, error) {
            console.error('Error al verificar username:', error);
            callback(false);
        }
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

// Cargar información del empleado
function cargarInfoEmpleado(empleadoId) {


    // Mostrar loading
    $('#infoEmpleadoCard').hide();
    $('#infoNombre').html('<i class="fas fa-spinner fa-spin"></i> Cargando...');
    $('#infoCargo').text('');
    $('#infoEmail').text('');

    const url = BASE_URL + "Empleados/obtenerEmpleado";

    $.ajax({
        url: url,
        type: 'POST', // Puedes cambiar a GET si prefieres
        dataType: 'json',
        data: { id_empleado: empleadoId },
        success: function (response) {

            if (response.estado === 'success' && response.data) {
                const emp = response.data;

                $('#infoNombre').text(emp.nombre_completo);
                $('#infoCargo').text(emp.cargo);
                $('#infoEmail').text(emp.email || 'No especificado');

                $('#infoEmpleadoCard').slideDown();

            } else {
                console.log('Error en la respuesta:', response.mensaje);
                $('#infoEmpleadoCard').hide();
            }
        },
        error: function (xhr, status, error) {
            console.error('Error en AJAX:', error);
            console.log('Status:', status);
            console.log('Respuesta del servidor:', xhr.responseText);
            $('#infoEmpleadoCard').hide();
        }
    });
}

// Resetear formulario
function resetForm() {
    document.getElementById("frmAgregarUsuario").reset();
    $('#infoEmpleadoCard').hide();
    $('#passwordMatch').html('');
    $('#vistaPreviaFotoUsuario').hide();
    $('.custom-file-label').text('Seleccionar archivo');

    // Remover clases de validación
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');

    // Resetear Select2
    $('#id_empleado').val(null).trigger('change');
    $('#id_sucursal').val(null).trigger('change');
}