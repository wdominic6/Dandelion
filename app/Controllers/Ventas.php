<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ventasmodel;
use App\Models\temporalcompramodel;
use App\Models\detalleventamodel;
use App\Models\productosmodel;
use App\Models\configuracionmodel;
use App\Models\clientesmodel;

class Ventas extends BaseController
{
    protected $ventas;
    protected $temporal_compra;
    protected $detalle_venta;
    protected $productos;
    protected $configuracion;
    protected $clientes;

    public function __construct()
    {
        $this->ventas = new ventasmodel();
        $this->temporal_compra = new temporalcompramodel();
        $this->detalle_venta = new detalleventamodel();
        $this->productos = new productosmodel();
        $this->configuracion = new configuracionmodel();
        $this->clientes = new clientesmodel();
        helper(['form']);
    }

    public function index($activo = 1)
    {
        return redirect()->to(base_url('ventas/venta'));
    }

    public function venta()
    {
        return view('header')
            . view('ventas/caja')
            . view('footer');
    }

    public function caja()
    {
        return $this->venta();
    }

    public function guarda()
    {
        $id_venta = $this->request->getPost('id_venta');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));
        $forma_pago = $this->request->getPost('forma_pago');
        $id_cliente = $this->request->getPost('id_cliente');

        $session = session();
        $id_usuario = $session->id_usuario ?? null;
        $id_caja = $session->id_caja ?? null;

        $resultadoId = $this->ventas->insertaVenta($id_venta, $total, $id_usuario, $id_caja, $id_cliente, $forma_pago);
        if ($resultadoId) {
            $resultadoVenta = $this->temporal_compra->porCompra($id_venta);
            foreach ($resultadoVenta as $row) {
                $this->detalle_venta->save([
                    'id_venta'   => $resultadoId,
                    'id_producto' => $row['id_producto'],
                    'nombre'      => $row['nombre'],
                    'cantidad'    => $row['cantidad'],
                    'precio'      => $row['precio'],
                ]);
                $this->productos->actualizaStock($row['id_producto'], $row['cantidad'], '-');
            }
            $this->temporal_compra->eliminarCompra($id_venta);
        }

        return redirect()->to(base_url('ventas/muestraTicket/' . $resultadoId));
    }

    public function muestraTicket($id_venta)
    {
        $data = ['id_venta' => $id_venta];
        return view('header')
            . view('ventas/ver_ticket', $data)
            . view('footer');
    }

    public function generaTicket($id_venta)
    {
        $venta = $this->ventas->where('id', $id_venta)->first();
        if (!$venta) {
            return redirect()->to(base_url('ventas/venta'));
        }

        $detalleVenta = $this->detalle_venta->where('id_venta', $id_venta)->findAll();

        $nombreTienda = $this->configuracion->select('valor')
            ->where('nombre', 'tienda_nombre')
            ->get()
            ->getRow('valor') ?? 'Dandelion';
        $direccionTienda = $this->configuracion->select('valor')
            ->where('nombre', 'tienda_direccion')
            ->get()
            ->getRow('valor') ?? '';

        $clienteNombre = 'Publico general';
        if (!empty($venta['id_cliente'])) {
            $cliente = $this->clientes->where('id', $venta['id_cliente'])->first();
            if (!empty($cliente['nombre'])) {
                $clienteNombre = $cliente['nombre'];
            }
        }

        $formasPago = [
            '001' => 'Efectivo',
            '002' => 'Tarjeta',
            '003' => 'Transferencia',
        ];

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle('Venta');
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(195, 5, 'Ticket de venta', 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        $logoPath = base_url() . '/images/Dandelion_logo.png';
        $pdf->Image($logoPath, 185, 10, 20, 20, 'PNG');

        $pdf->Cell(50, 5, $nombreTienda, 0, 1, 'L');
        if ($direccionTienda !== '') {
            $pdf->SetFont('Arial', '', 9);
            $pdf->Cell(20, 5, 'Direccion: ', 0, 0, 'L');
            $pdf->Cell(50, 5, utf8_decode($direccionTienda), 0, 1, 'L');
        }

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, 'Folio: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $venta['folio'], 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, 'Cliente: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, utf8_decode($clienteNombre), 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, 'Pago: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $formasPago[$venta['forma_pago']] ?? 'Otro', 0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, 'Fecha y hora: ', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $venta['fecha_creacion'], 0, 1, 'L');

        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(15, 23, 42);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 5, 'Detalle de productos', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, 'No', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Codigo', 1, 0, 'L');
        $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Importe', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $contador = 1;

        foreach ($detalleVenta as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(25, 5, $row['id_producto'], 1, 0, 'L');
            $pdf->Cell(77, 5, utf8_decode($row['nombre']), 1, 0, 'L');
            $pdf->Cell(25, 5, $row['precio'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['cantidad'], 1, 0, 'L');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(30, 5, '$' . $importe, 1, 1, 'R');
            $contador++;
        }

        $pdf->Ln();
        $pdf->Cell(195, 5, 'Total: $' . number_format($venta['total'], 2, '.', ','), 0, 1, 'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output('venta_ticket.pdf', 'I');
    }
}
