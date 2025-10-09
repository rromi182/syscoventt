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
                "render": function(data) {
                    return '₲' + parseFloat(data).toLocaleString('es-AR');
                }
            },
            {
                "data": "foto",
                "render": function(data, type, row) {
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
    $(document).on('click', '.img-clickable', function() {
        const imagenSrc = $(this).data('imagen');
        const descripcion = $(this).data('descripcion');
        
        $('#imagenAmpliada').attr('src', imagenSrc);
        $('#tituloImagen').text(descripcion);
        $('#modalImagen').modal('show');
    });

    // Vista previa de imagen en el modal de agregar
    $('#imagen').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
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
        setTimeout(function() {
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
        setTimeout(function() {
            // Enfocar la última imagen clickeada o mantener el foco en la tabla
            $('.img-clickable').focus();
        }, 100);
    });
});

// Evento para abrir modal de nuevo artículo
function frmAgregarArticulo(){
    $("#modalAgregarArticulo").modal("show");
    // Limpiar formulario
    $('#frmAgregarArticulo')[0].reset();
    $('#vistaPrevia').hide();
    $('.custom-file-label').text('Seleccionar archivo');
}

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