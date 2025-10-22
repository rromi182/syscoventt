let tblPedidosCompras;

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar DataTable
    tblPedidosCompras = $("#tblPedidosCompras").DataTable({
        "ajax": {
            "url": BASE_URL + "PedidosCompras/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "id_pedido_compra" },
            { "data": "fecha_registro" },
            { "data": "username" },
            { "data": "sucursal" },
            {"data": "estado"},
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-primary edit-articulo" data-id="${row.id_pedido_compra}">
                            <i class="fas fa-edit"></i> Aprobar
                        </button>
                        <button class="btn btn-sm btn-danger delete-articulo" data-id="${row.id_pedido_compra}">
                            <i class="fas fa-trash"></i> Anular
                        </button>
                    `;
                },
                "orderable": false,
                "searchable": false
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

    // Inicializar eventos
   // initModalEvents();
});
