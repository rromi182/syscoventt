let tblCategorias;

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    tblCategorias = $("#tblCategorias").DataTable({
        "ajax": {
            "url": BASE_URL + "Categorias/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_categoria" },
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
                       
                            
                            <button class="btn btn-sm btn-primary edit-categoria" data-id="${row.id_categoria}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger delete-categoria" data-id="${row.id_categoria}">
                            <i class="fas fa-trash"></i> Eliminar
                        
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

    

    // Guardar categoria
    $('#btnGuardarCategoria').click(function () {
        guardarCategoria();
    });

    // Enter en el formulario
    $('#formCategoria').on('keypress', function (e) {
        if (e.which === 13) {
            guardarCategoria();
            return false;
        }
    });

    // Editar categoria
    $(document).on('click', '.edit-categoria', function () {
        const id = $(this).data('id');
        editarCategoria(id);
    });

    // Eliminar categoria
    $(document).on('click', '.delete-categoria', function () {
        const id = $(this).data('id');
        eliminarCategoria(id);
    });
});

/*
// Evento para abrir modal de nueva categoria
*/
function frmAgregarCategoria(){
    $("#modalAgregarCategoria").modal("show");
    //cargarDatosModal();
}

