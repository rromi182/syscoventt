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

    // Evento para hacer click en las imágenes en el listado
    $(document).on('click', '.img-clickable', function () {
        const imagenSrc = $(this).data('imagen');
        const descripcion = $(this).data('descripcion');

        $('#imagenAmpliada').attr('src', imagenSrc);
        $('#tituloImagen').text(descripcion);
        $('#modalImagen').modal('show');
    });

    // Vista previa de imagen
    $('#imagen').on('change', function () {
        const file = this.files[0];
        if (file) {
            // Validar tipo de archivo
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Formato no válido',
                    text: 'Solo se permiten archivos JPG, JPEG o PNG',
                    confirmButtonText: 'Entendido',
                    scrollbarPadding: false,
                    heightAuto: false
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
                    confirmButtonText: 'Entendido',
                    scrollbarPadding: false,
                    heightAuto: false
                });
                $(this).val('');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                $('#previewImg').attr('src', e.target.result);
                $('#vistaPrevia').show();
            }
            reader.readAsDataURL(file);

            // Mostrar nombre del archivo
            $('.custom-file-label').text(file.name);
        } else {
            $('#vistaPrevia').hide();
            $('.custom-file-label').text('Seleccionar archivo');
        }
    });

    // Enter en el formulario
    $('#frmAgregarArticulo').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // Eventos del modal
    $('#modalAgregarArticulo').on('hidden.bs.modal', function () {
        resetFormArticulo();
    });

    // Inicializar eventos UNA SOLA VEZ
    initModalArticulosEvents();
});



// Función para abrir el modal
function frmAgregarArticulo() {
    console.log('Abriendo modal...');
    resetFormArticulo();
    $("#modalAgregarArticulo").modal("show");
}

// Función para ver imagen en modal
function verImagen(ruta) {
    $('#imagenAmpliada').attr('src', ruta);
    $('#modalImagen').modal('show');
}

// Función principal para agregar artículo
function agregarArticulo(e) {
    e.preventDefault();

    // Obtener todos los campos del formulario
    const codigoInput = document.getElementById("codigo");
    const descripcionInput = document.getElementById("descripcion");
    const precioInput = document.getElementById("precio");
    const stock_minimoInput = document.getElementById("stock_minimo");
    const marcaInput = document.getElementById("id_marca");
    const categoriaInput = document.getElementById("id_categoria");

    // Obtener valores
    const codigo = codigoInput.value.trim();
    const descripcion = descripcionInput.value.trim();
    const precio = precioInput.value.trim();
    const stock_minimo = stock_minimoInput.value.trim();
    const marca = marcaInput.value;
    const categoria = categoriaInput.value;


    // Remover clases de error previas
    codigoInput.classList.remove("is-invalid");
    descripcionInput.classList.remove("is-invalid");
    precioInput.classList.remove("is-invalid");
    stock_minimoInput.classList.remove("is-invalid");
    marcaInput.classList.remove("is-invalid");
    categoriaInput.classList.remove("is-invalid");

    // Validar campos vacíos
    if (codigo === "" || descripcion === "" || precio === "" || stock_minimo === "" || marca === "" || categoria === "") {
        let camposVacios = [];

        if (codigo === "") {
            codigoInput.classList.add("is-invalid");
            camposVacios.push("Código");
        }
        if (descripcion === "") {
            descripcionInput.classList.add("is-invalid");
            camposVacios.push("Descripción");
        }
        if (precio === "") {
            precioInput.classList.add("is-invalid");
            camposVacios.push("Precio");
        }
        if (stock_minimo === "") {
            stock_minimoInput.classList.add("is-invalid");
            camposVacios.push("Stock");
        }
        if (marca === "") {
            marcaInput.classList.add("is-invalid");
            camposVacios.push("Marca");
        }
        if (categoria === "") {
            categoriaInput.classList.add("is-invalid");
            camposVacios.push("Categoría");
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
        if (codigo === "") codigoInput.focus();
        else if (descripcion === "") descripcionInput.focus();
        else if (precio === "") precioInput.focus();
        else if (stock_minimo === "") stock_minimoInput.focus();
        else if (marca === "") marcaInput.focus();
        else categoriaInput.focus();

        return;
    }

    // Validar que el precio sea mayor a 0
    if (parseFloat(precio) <= 0) {
        precioInput.classList.add("is-invalid");
        Swal.fire({
            icon: 'error',
            title: 'Precio inválido',
            text: 'El precio debe ser mayor a 0.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });
        precioInput.focus();
        return;
    }

    // Validar que el stock sea mayor a 0
    if (parseInt(stock_minimo) <= 0) {
        stock_minimoInput.classList.add("is-invalid");
        Swal.fire({
            icon: 'error',
            title: 'Stock inválido',
            text: 'El stock mínimo debe ser mayor a 0.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        });
        stock_minimoInput.focus();
        return;
    }

   // console.log("Datos a enviar: ", "Código: " + codigo, "Descripción: " + descripcion, "Precio: " + precio, "Stock Minimo: " + stock_minimo, "Marca: " + marca, "Categoría: " + categoria);


    verificarCodigo(codigo, function (existe) {
    if (existe) {
        Swal.fire({
            icon: 'error',
            title: 'Código no disponible',
            text: 'El código "' + codigo + '" ya está en uso. Por favor usa otro código.',
            confirmButtonText: 'Entendido',
            scrollbarPadding: false,
            heightAuto: false
        }).then((result) => {
            if (result.isConfirmed) {
                // SOLUCIÓN: Esperar a que el modal de SweetAlert se cierre completamente
                setTimeout(() => {
                    codigoInput.focus();
                    codigoInput.select();
                }, 300);
            }
        });
        return;
    }

        // Si todas las validaciones pasan, enviar el formulario
        const url = BASE_URL + "Articulos/agregar";
        const form = document.getElementById("frmAgregarArticulo");
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
                        title: 'Artículo agregado',
                        text: 'El artículo ha sido registrado exitosamente.',
                        confirmButtonText: 'Entendido',
                        scrollbarPadding: false,
                        heightAuto: false
                    })
                        .then(() => {
                            resetFormArticulo();
                            $('#modalAgregarArticulo').modal('hide');
                            // Recargar la tabla
                            tblArticulos.ajax.reload();
                        });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al crear artículo',
                        text: response,
                        confirmButtonText: 'Entendido',
                        scrollbarPadding: false,
                        heightAuto: false
                    });
                }
            }
        };
    });
}

// Inicializar eventos del modal de artículos
function initModalArticulosEvents() {
    console.log('Inicializando eventos del modal...');
    
    // LIMPIAR EVENTOS ANTERIORES
    $('#frmAgregarArticulo').off('submit');
    $('#codigo').off('blur.codigo');
    
    // Inicializar Select2
    $('#id_marca').select2({
        theme: 'bootstrap-5',
        placeholder: 'Seleccionar marca',
        allowClear: true,
        width: '100%'
    });

    $('#id_categoria').select2({
        theme: 'bootstrap-5',
        placeholder: 'Seleccionar categoría',
        allowClear: true,
        width: '100%'
    });
    

    // Enviar formulario
    $('#frmAgregarArticulo').on('submit', function (e) {
        agregarArticulo(e);
    });
}

// Verificar si el código ya existe
let codigoTimeout;
function verificarCodigo(codigo, callback) {
    if (!codigo || codigo.trim() === '') {
        callback(false);
        return;
    }

    // Evitar múltiples llamadas rápidas
    clearTimeout(codigoTimeout);
    codigoTimeout = setTimeout(function() {
        const url = BASE_URL + "Articulos/verificarCodigo";
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { codigo: codigo },
            success: function (response) {
                callback(response.existe);
            },
            error: function (xhr, status, error) {
                console.error('Error al verificar código:', error);
                callback(false);
            }
        });
    }, 300);
}

// Resetear formulario de artículos
function resetFormArticulo() {
    document.getElementById("frmAgregarArticulo").reset();
    $('#vistaPrevia').hide();
    $('.custom-file-label').text('Seleccionar archivo');

    // Remover clases de validación
    $('.is-invalid').removeClass('is-invalid');
    $('.is-valid').removeClass('is-valid');

    // Resetear Select2
    $('#id_marca').val(null).trigger('change');
    $('#id_categoria').val(null).trigger('change');
}