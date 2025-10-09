let tblMarcas;

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    tblMarcas = $("#tblMarcas").DataTable({
        "ajax": {
            "url": BASE_URL + "Marcas/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_marca" },
            { "data": "marca_descrip" },
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
                       
                            
                            <button class="btn btn-sm btn-primary edit-marca" data-id="${row.id_marca}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <button class="btn btn-sm btn-danger delete-marca" data-id="${row.id_marca}">
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

    

    // Guardar marca
    $('#btnGuardarMarca').click(function () {
        guardarMarca();
    });

    // Enter en el formulario
    $('#formMarca').on('keypress', function (e) {
        if (e.which === 13) {
            guardarMarca();
            return false;
        }
    });

    // Editar marca
    $(document).on('click', '.edit-marca', function () {
        const id = $(this).data('id');
        editarMarca(id);
    });

    // Eliminar marca
    $(document).on('click', '.delete-marca', function () {
        const id = $(this).data('id');
        eliminarMarca(id);
    });
});

// Evento para abrir modal de nueva marca
function frmAgregarMarca(){
    $("#modalAgregarMarca").modal("show");
    //cargarDatosModal();
}

