let tblArticulos;

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    tblArticulos = $("#tblArticulos").DataTable({
        "ajax": {
            "url": BASE_URL + "Articulos/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_articulo" },
            { "data": "codigo_articulo" },
            { "data": "articulo_descrip" },
            {
                "data": "precio",
                "render": function (data) {
                    return '₲' + parseFloat(data).toLocaleString('es-AR');
                }
            },
            {
                "data": "foto",
                "render": function (data, type, row) {
                    if (data) {
                        return `
                            <div class="text-center">
                                <img src="${BASE_URL}assets/img/articulos/${data}" 
                                     alt="${row.articulo_descrip}" 
                                     style="max-height: 50px; max-width: 50px; cursor: pointer;" 
                                     class="img-thumbnail img-clickable"
                                     data-imagen="${BASE_URL}assets/img/articulos/${data}"
                                     data-descripcion="${row.articulo_descrip}">
                                <br>
                            </div>
                        `;
                    }
                    return '<span class="badge badge-secondary">Sin imagen</span>';
                }
            },
            { "data": "stock_minimo" },
            { "data": "marca_descrip" },
            { "data": "categoria_descrip" },
            {
                "data": "estado",
                "render": function (data) {
                    return data === 'ACTIVO' ?
                        '<span class="badge badge-success">ACTIVO</span>' :
                        '<span class="badge badge-secondary">INACTIVO</span>';
                }
            },
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary edit-articulo" data-id="${row.id_articulo}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger delete-articulo" data-id="${row.id_articulo}">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    `;
                },
                "orderable": false,
                "searchable": false
            }
        ],
        "responsive": true,
        "autoWidth": false,
        "language": {
            "url": BASE_URL + "assets/plugins/datatables/spanish.json"
        }
    });

    // Evento para hacer click en las imágenes
    $(document).on('click', '.img-clickable', function () {
        const imagenSrc = $(this).data('imagen');
        const descripcion = $(this).data('descripcion');

        $('#imagenAmpliada').attr('src', imagenSrc);
        $('#tituloImagen').text(descripcion);
        $('#modalImagen').modal('show');
    });

    // Vista previa de imagen en el modal de agregar
    $('#imagen').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImg').attr('src', e.target.result);
                $('#vistaPrevia').show();
            }
            reader.readAsDataURL(file);

            // Mostrar nombre del archivo
            $('.custom-file-label').text(file.name);
        }
    });

    // Enter en el formulario
    $('#frmAgregarArticulo').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // ========== CONFIGURACIÓN PARA MODAL DE AGREGAR ARTÍCULO ==========
    $('#modalAgregarArticulo').on('hidden.bs.modal', function () {
        // Remover el atributo aria-hidden y restaurar la interactividad
        $(this).removeAttr('aria-hidden');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    // También puedes forzar el foco a otro elemento cuando se cierra
    $('#modalAgregarArticulo').on('hide.bs.modal', function () {
        // Mover el foco al botón de agregar o a otro elemento seguro
        setTimeout(function () {
            $('.add-articulo').focus();
        }, 100);
    });

    // ========== CONFIGURACIÓN PARA MODAL DE IMAGEN ==========
    $('#modalImagen').on('hidden.bs.modal', function () {
        $(this).removeAttr('aria-hidden');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });

    $('#modalImagen').on('hide.bs.modal', function () {
        setTimeout(function () {
            // Enfocar la última imagen clickeada o mantener el foco en la tabla
            $('.img-clickable').focus();
        }, 100);
    });
});

// Función para mostrar SweetAlert
function showAlert(icon, title, text, timer = null) {
    const config = {
        icon: icon,
        title: title,
        text: text,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    };

    if (timer) {
        config.timer = timer;
        config.showConfirmButton = false;
    }

    return Swal.fire(config);
}

// Evento para abrir modal de nuevo artículo
function frmAgregarArticulo() {
    $("#modalAgregarArticulo").modal("show");
    // Limpiar formulario
    $('#frmAgregarArticulo')[0].reset();
    $('#vistaPrevia').hide();
    $('.custom-file-label').text('Seleccionar archivo');
}

// Validaciones para el formulario de artículos
function initArticuloValidations() {
    // Limpiar validaciones anteriores
    $('#frmAgregarArticulo').find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
    $('#frmAgregarArticulo').find('.invalid-feedback').remove();

    // Validar código (solo letras, números y guiones)
    $('#codigo').on('input', function () {
        let value = $(this).val();
        // Permitir solo letras, números y guiones
        value = value.replace(/[^a-zA-Z0-9\-]/g, '');
        $(this).val(value.toUpperCase());

        // Validar longitud
        if (value.length > 50) {
            $(this).val(value.substring(0, 50));
            showValidationMessage(this, 'El código no puede exceder los 50 caracteres');
        } else {
            hideValidationMessage(this);
        }
    });

    // Validar descripción
    $('#descripcion').on('input', function () {
        let value = $(this).val();
        // Permitir letras, números, espacios y algunos caracteres especiales
        value = value.replace(/[^a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-\_\.\,\!\?]/g, '');
        $(this).val(value.toUpperCase());

        // Validar longitud
        if (value.length > 255) {
            $(this).val(value.substring(0, 255));
            showValidationMessage(this, 'La descripción no puede exceder los 255 caracteres');
        } else {
            hideValidationMessage(this);
        }
    });

    // Validar precio (solo números enteros)
    $('#precio').on('input', function () {
        let value = $(this).val();
        // Remover cualquier caracter que no sea número
        value = value.replace(/[^\d]/g, '');
        $(this).val(value);

        // Validar rango
        if (value && parseInt(value) > 999999999) {
            $(this).val('999999999');
            showValidationMessage(this, 'El precio no puede exceder 999.999.999');
        } else {
            hideValidationMessage(this);
        }
    });

    // Formatear precio al perder el foco
    $('#precio').on('blur', function () {
        let value = $(this).val();
        if (value) {
            $(this).val(parseInt(value).toLocaleString('es-AR'));
        }
    });

    // Quitar formato al enfocar
    $('#precio').on('focus', function () {
        let value = $(this).val().replace(/\./g, '');
        $(this).val(value);
    });

    // Validar stock (solo números enteros positivos)
    $('#stock').on('input', function () {
        let value = $(this).val();
        // Remover cualquier caracter que no sea número
        value = value.replace(/[^\d]/g, '');
        $(this).val(value);

        // Validar rango
        if (value && parseInt(value) > 999999) {
            $(this).val('999999');
            showValidationMessage(this, 'El stock no puede exceder 999.999');
        } else {
            hideValidationMessage(this);
        }
    });

    // Validar imagen
    $('#imagen').on('change', function () {
        const file = this.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB en bytes
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];

        if (file) {
            // Validar tipo de archivo
            if (!allowedTypes.includes(file.type)) {
                showValidationMessage(this, 'Solo se permiten archivos JPG, JPEG y PNG');
                $(this).val('');
                $('#vistaPrevia').hide();
                $('.custom-file-label').text('Seleccionar archivo');
                return;
            }

            // Validar tamaño
            if (file.size > maxSize) {
                showValidationMessage(this, 'La imagen no puede exceder los 2MB');
                $(this).val('');
                $('#vistaPrevia').hide();
                $('.custom-file-label').text('Seleccionar archivo');
                return;
            }

            hideValidationMessage(this);

            // Mostrar vista previa
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImg').attr('src', e.target.result);
                $('#vistaPrevia').show();
            }
            reader.readAsDataURL(file);

            // Mostrar nombre del archivo
            $('.custom-file-label').text(file.name);
        }
    });

    // Validar selects
    $('#id_marca, #id_categoria').on('change', function () {
        if ($(this).val()) {
            hideValidationMessage(this);
        }
    });

    // REMOVER EL EVENTO SUBMIT ANTERIOR Y REEMPLAZARLO POR ESTE:
    // Solo validar al hacer submit, no mostrar alertas inmediatas
    $('#frmAgregarArticulo').off('submit').on('submit', function (e) {
        e.preventDefault();
        
        // Solo validar sin mostrar alertas de SweetAlert
        if (!validateFormSilent()) {
            // Enfocar el primer campo con error
            const firstError = $('#frmAgregarArticulo').find('.is-invalid').first();
            if (firstError.length) {
                firstError.focus();
            }
            return false;
        }
        
        // Si pasa la validación, enviar el formulario
        AgregarArticuloForm();
    });
}

// Función para validar todo el formulario
function validateForm() {
    let isValid = true;

    // Validar código
    if (!$('#codigo').val().trim()) {
        showValidationMessage('#codigo', 'El código es obligatorio');
        isValid = false;
    }

    // Validar descripción
    if (!$('#descripcion').val().trim()) {
        showValidationMessage('#descripcion', 'La descripción es obligatoria');
        isValid = false;
    }

    // Validar precio
    const precioValue = $('#precio').val().replace(/\./g, '');
    if (!precioValue) {
        showValidationMessage('#precio', 'El precio es obligatorio');
        isValid = false;
    } else if (parseInt(precioValue) <= 0) {
        showValidationMessage('#precio', 'El precio debe ser mayor a 0');
        isValid = false;
    }

    // Validar stock
    if (!$('#stock').val().trim()) {
        showValidationMessage('#stock', 'El stock es obligatorio');
        isValid = false;
    } else if (parseInt($('#stock').val()) <= 0) {
        showValidationMessage('#stock', 'El stock debe ser mayor a 0');
        isValid = false;
    }

    // Validar marca
    if (!$('#id_marca').val()) {
        showValidationMessage('#id_marca', 'Debe seleccionar una marca');
        isValid = false;
    }

    // Validar categoría
    if (!$('#id_categoria').val()) {
        showValidationMessage('#id_categoria', 'Debe seleccionar una categoría');
        isValid = false;
    }

    return isValid;
}

// Función para mostrar mensajes de validación
function showValidationMessage(element, message) {
    const $element = $(element);
    const $formGroup = $element.closest('.form-group');

    // Remover mensaje anterior
    $formGroup.find('.invalid-feedback').remove();
    $element.removeClass('is-valid').addClass('is-invalid');

    // Agregar nuevo mensaje
    $formGroup.append(`<div class="invalid-feedback">${message}</div>`);
}

// Función para ocultar mensajes de validación
function hideValidationMessage(element) {
    const $element = $(element);
    const $formGroup = $element.closest('.form-group');

    $formGroup.find('.invalid-feedback').remove();
    $element.removeClass('is-invalid').addClass('is-valid');
}

// Función para enviar el formulario
function AgregarArticuloForm() {
    // Validar formulario antes de enviar
    if (!validateForm()) {
        showAlert('warning', 'Validación', 'Por favor complete todos los campos correctamente');
        return false;
    }

    const formData = new FormData($('#frmAgregarArticulo')[0]);

    // Mostrar loading
    Swal.fire({
        title: 'Guardando...',
        text: 'Por favor espere',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    $.ajax({
        url: BASE_URL + 'Articulos/agregar',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            Swal.close();
            
            if (response.status) {
                showAlert('success', 'Éxito', response.msg, 2000).then(() => {
                    $('#modalAgregarArticulo').modal('hide');
                    // Recargar la tabla
                    tblArticulos.ajax.reload();
                });
            } else {
                showAlert('error', 'Error', response.msg);
            }
        },
        error: function (xhr, status, error) {
            Swal.close();
            console.error('Error al guardar artículo:', error);
            
            let errorMsg = 'Error en la comunicación con el servidor';
            try {
                // Intentar parsear el error si viene en JSON
                const response = JSON.parse(xhr.responseText);
                errorMsg = response.msg || errorMsg;
            } catch (e) {
                // Si no es JSON, usar el texto plano truncado
                errorMsg = xhr.responseText ? xhr.responseText.substring(0, 200) + '...' : errorMsg;
            }
            
            showAlert('error', 'Error del servidor', errorMsg);
        }
    });
}

// Inicializar validaciones cuando se abre el modal
$('#modalAgregarArticulo').on('shown.bs.modal', function () {
    initArticuloValidations();
});

// Limpiar validaciones cuando se cierra el modal
$('#modalAgregarArticulo').on('hidden.bs.modal', function () {
    // Remover clases de validación
    $(this).find('.is-invalid, .is-valid').removeClass('is-invalid is-valid');
    $(this).find('.invalid-feedback').remove();
});

// Para editar (solo la función base por ahora)
function editarArticulo(id) {
    console.log("Editar artículo ID:", id);
    // Aquí implementarás la lógica para cargar datos en el modal
}

// Para eliminar (solo la función base por ahora)
function eliminarArticulo(id) {
    console.log("Eliminar artículo ID:", id);
    // Aquí implementarás la lógica para eliminar
}