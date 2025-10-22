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
            { "data": "nombre_completo" },
            { "data": "sucursal" },
            {"data": "estado"},
            {
                "data": null,
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-sm btn-success" data-toggle="tooltip" title="Aprobar Pedido" 
                        onclick="aprobarPedido(${row.id_pedido_compra})">
                            <i class="fas fa-check"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="Anular Pedido" 
                        onclick="anularPedido(${row.id_pedido_compra})">
                            <i class="fas fa-ban"></i>
                        </button>
                        <button class="btn btn-sm btn-warning" data-toggle="tooltip" title="Imprimir Informe" 
                        onclick="generarInformePedido(${row.id_pedido_compra})">
                            <i class="fas fa-print"></i>
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

/*
//Funcion para generar Informe
*/
function generarInformePedido(id_pedido_compra) {

    const ruta = BASE_URL + "PedidosCompras/generarInformePedido/"+ id_pedido_compra;//Prueba despues poner el id del pedido correspondiente    
    // Abrir en nueva ventana y luego imprimir
    const abrir = window.open(ruta, '_blank');
    
    // Esperar a que cargue la ventana y luego imprimir
    abrir.onload = function() {
        abrir.print();
        // Opcional: cerrar después de imprimir
        abrir.onafterprint = function() { abrir.close(); };
    };
}
