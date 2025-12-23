<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\comprasmodel;
use App\Models\temporalcompramodel;
use App\Models\detallecompramodel;
use App\Models\productosmodel;
use App\Models\configuracionmodel;

class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $productos, $configuracion;
    protected $reglas;
    public function __construct()
    {
        $this->compras = new \App\Models\comprasmodel();
        $this->detalle_compra = new \App\Models\detallecompramodel();
        $this->configuracion = new \App\Models\configuracionmodel();
        helper(['form']);

    }
    public function index($activo = 1)
    {
        $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Compras', 'compras' => $compras];

        return
            view('header')
            . view('compras/compras', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades eliminadas', 'datos' => $compras];

        return
            view('header')
            . view('compras/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        return
            view('header')
            . view('compras/nuevo')
            . view('footer');
    }
    public function guarda()
    {
        $id_compra = $this->request->getPost('id_compra');
        $total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));
        $session = session();
        $resultadoId = $this->compras->insertaCompra($id_compra, $total, $session->id_usuario);
        $this->temporal_compra = new \App\Models\temporalcompramodel();
        if($resultadoId){
            $resultadoCompra = $this->temporal_compra->porCompra($id_compra);
            foreach($resultadoCompra as $row){
                $this->detalle_compra->save([
                    'id_compra'   => $resultadoId,
                    'id_producto' => $row['id_producto'],
                    'nombre'      => $row['nombre'],
                    'cantidad'    => $row['cantidad'],
                    'precio'      => $row['precio'],
                ]);
                $this->productos = new \App\Models\productosmodel();
                $this->productos->actualizaStock($row['id_producto'], $row['cantidad']);
            }
            $this->temporal_compra->eliminarCompra($id_compra);
        }
        return redirect()->to(base_url().'/compras/muestraCompraPdf/'.$resultadoId);
    }
    function muestraCompraPdf($id_compra){
        $data['id_compra'] = $id_compra;
        return
            view('header')
            . view('compras/ver_compra_pdf', $data)
            . view('footer');

    }
    function generaCompraPdf($id_compra){

        $datosCompra = $this->compras->where('id', $id_compra)->first();
        $this->detalle_compra->select('*');
        $detalleCompra = $this->detalle_compra->where('id_compra', $id_compra)->findAll();
        $nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
        $direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;

        $pdf = new \FPDF('P', 'mm', 'letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Compra");
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->Cell(195, 5, "Entrada de productos", 0, 1, 'C');
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->image(base_url().'/images/Dandelion_logo.png', 185, 10, 20, 20, 'PNG');
        $pdf->Cell(50, 5, $nombreTienda, 0, 1, 'L');
        $pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, utf8_decode($direccionTienda), 0, 1, 'L');
        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 5, utf8_decode('Fecha y hora: '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(50, 5, $datosCompra['fecha_creacion'], 0, 1, 'L');

        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(195, 5, 'Detalle de Productos', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(14, 5, 'No', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Codigo', 1, 0, 'L');
        $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(25, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(30, 5, 'Importe', 1, 1, 'L');
        $pdf->SetFont('Arial', '', 8);
        $contador = 1;

        foreach ($detalleCompra as $row) {
            $pdf->Cell(14, 5, $contador, 1, 0, 'L');
            $pdf->Cell(25, 5, $row['id_producto'], 1, 0, 'L');
            $pdf->Cell(77, 5, $row['nombre'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['precio'], 1, 0, 'L');
            $pdf->Cell(25, 5, $row['cantidad'], 1, 0, 'L');
            $importe = number_format($row['precio'] * $row['cantidad'], 2, '.', ',');
            $pdf->Cell(30, 5, '$' . $importe, 1, 1, 'R');
            $contador++;
        }

        $pdf->Ln();
        $pdf->Cell(195, 5, 'Total: $' . number_format($datosCompra['total'], 2, '.', ','), 0, 1, 'R');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("compra_pdf.pdf", 'I');
         
    }

}