<?php

class PedidosCompras extends Controller
{

    protected $empleadosModel;
    protected $articulosModel;
    protected $sucursalesModel;
    protected $pedidosComprasModel;

    public function __construct()
    {
        session_start();
        parent::__construct();

        // Cargar modelos adicionales usando el método model() del padre
        $this->empleadosModel = $this->model('EmpleadosModel');
        $this->articulosModel = $this->model('ArticulosModel');
        $this->sucursalesModel = $this->model('SucursalesModel');
        $this->pedidosComprasModel = $this->model('PedidosComprasModel');
    }

    public function index()
    {
        // Obtener datos usando los modelos ya cargados
        $data['empleados'] = $this->empleadosModel->getEmpleadosSinUsuario();
        $data['sucursales'] = $this->sucursalesModel->getSucursales();
        $data['pedidos'] = $this->pedidosComprasModel->getPedidosCompras();
        $this->views->getView($this, "listar", $data);
    }

    public function listar()
    {
        $data = $this->pedidosComprasModel->getPedidosCompras();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /*
    //Funcion para mostrar el formulario de agregar pedido
    */ 
    public function agregar()
    {
        $data['sucursales'] = $this->sucursalesModel->getSucursales();
        $data['articulos'] = $this->articulosModel->getArticulos(); // Asegúrate de tener este método
        $this->views->getView($this, "agregar", $data);
    }

    /*
    //Funcion para agregar pedido
    */ 
    public function agregarPedido()
    {
        // $this->pedidosComprasModel->agregarPedido();
        // $this->index();
    }

    public function generarInformePedido($id_pedido_compra)
    {
        require('libraries/fpdf/fpdf.php');

        // Obtener datos del pedido
        $pedido = $this->pedidosComprasModel->getPedidosComprasById($id_pedido_compra);
        $detalles = $this->pedidosComprasModel->getPedidoComprasDetalles($id_pedido_compra);

        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetTitle('Pedido de Compra');

        // Configurar márgenes
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetAutoPageBreak(true, 20);

        // ========== ENCABEZADO ==========
        // Logo
        $pdf->Image('assets/img/logo-syscovent.png', 15, 6, 28, 28 );

        // Información de la empresa
        $pdf->SetFont('Times', 'B', 16);
        $pdf->SetXY(45, 12);
        $pdf->Cell(0, 6, 'TOP TIENDA', 0, 1);

        $pdf->SetFont('Times', '', 10);
        $pdf->SetX(45);
        $pdf->Cell(0, 5, 'Syscovent', 0, 1);
        $pdf->SetX(45);
        $pdf->Cell(0, 5, 'Tel: (123) 456-7890', 0, 1);
        $pdf->SetX(45);
        $pdf->Cell(0, 5, 'Email: info@toptienda.com', 0, 1);

        // Título del documento
        $pdf->SetY(45);
        $pdf->SetFont('Times', 'B', 18);
        $pdf->Cell(0, 10, 'PEDIDO DE COMPRA', 0, 1,);


        // Línea separadora
        $pdf->SetLineWidth(0.5);
        $pdf->Line(15, 58, 195, 58);

        // ========== INFORMACIÓN DE LA ORDEN ==========
        $pdf->SetY(65);

        // Columna izquierda - Información de la empresa
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Sucursal:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, $pedido['sucursal'] ?? 'Sucursal Principal', 0, 1);

        $pdf->SetX(15);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Responsable:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, $pedido['nombre_completo'] ?? 'No especificado', 0, 1);

        $pdf->SetX(15);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Estado:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6,$pedido['estado'] ?? 'Pendiente', 0, 1);

        // Columna derecha - Datos de la orden
        $pdf->SetXY(110, 65);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'No. de Pedido:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, 'PC-' . str_pad($id_pedido_compra, 6, '0', STR_PAD_LEFT), 0, 1);

        $pdf->SetX(110);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Fecha:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, date('d/m/Y', strtotime($pedido['fecha_registro'] ?? date('Y-m-d'))), 0, 1);

        $pdf->SetX(110);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Total Articulos:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, $pedido['total_articulos'] ?? '0', 0, 1);

        $pdf->SetX(110);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Total Cantidad:', 0, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, $pedido['total_cantidad'] ?? '0', 0, 1);

        // Espacio antes de la tabla
        $pdf->Ln(15);

        // ========== TABLA DE ARTÍCULOS DETALLADA ==========
        // Encabezado de la tabla
        $pdf->SetFillColor(200, 200, 200);
        $pdf->SetFont('Times', 'B', 11);

        $pdf->Cell(15, 8, '#', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'CODIGO', 1, 0, 'C', true);
        $pdf->Cell(120, 8, 'DESCRIPCION DEL ARTICULO', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'CANTIDAD', 1, 1, 'C', true);

        // Contenido de la tabla - Artículos individuales
        $pdf->SetFont('Times', '', 10);
        $contador = 1;
        $total_cantidad = 0;

        foreach ($detalles as $detalle) {
            // Obtener información completa del artículo
            $articulo = $this->articulosModel->getArticuloById($detalle['id_articulo']);
            $total_cantidad += $detalle['cantidad'];

            $pdf->Cell(15, 7, $contador, 1, 0, 'C');
            $pdf->Cell(25, 7, $articulo['codigo_articulo'] ?? 'N/A', 1, 0, 'C');
            $pdf->Cell(120, 7, substr($articulo['articulo_descrip'] ?? 'Articulo ' . $contador, 0, 60), 1, 0, 'C');
            $pdf->Cell(25, 7, number_format($detalle['cantidad'], 0), 1, 1, 'C');

            $contador++;
        }

        // Rellenar espacio vacío si hay pocos artículos
        if (count($detalles) < 10) {
            for ($i = count($detalles); $i < 10; $i++) {
                $pdf->Cell(15, 7, '', 1, 0, 'C');
                $pdf->Cell(25, 7, '', 1, 0, 'C');
                $pdf->Cell(120, 7, '', 1, 0);
                $pdf->Cell(25, 7, '', 1, 1, 'C');
            }
        }

        // ========== FILA DE TOTALES ==========
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(160, 8, 'TOTAL GENERAL', 1, 0, 'R', true);
        $pdf->Cell(25, 8, number_format($total_cantidad, 0), 1, 1, 'C', true);

        // ========== OBSERVACIONES Y FIRMA ==========
        $pdf->Ln(10);

        // Columna para observaciones
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(40, 6, 'Notas / Observaciones:', 0, 1);
        $pdf->SetFont('Times', '', 10);
        $pdf->MultiCell(0, 5, 'Este pedido debe ser entregado en la sucursal especificada. Verificar la calidad de los productos antes de aceptar la entrega.', 0, 'L');

        // Línea para firma
        $pdf->Ln(15);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(0, 6, 'Firma del Responsable: _________________________', 0, 1);
        $pdf->Cell(0, 6, 'Nombre: ' . $pedido['nombre_completo'] ?? 'Responsable', 0, 1);
        $pdf->Cell(0, 6, 'Fecha: ' . date('d/m/Y'), 0, 1);

        $pdf->Output('I', 'Pedido_Compra_' . $id_pedido_compra . '.pdf');
    }
}
