<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ventasmodel;
use App\Models\temporalcompramodel;
use App\Models\detalleventamodel;
use App\Models\productosmodel;

class Ventas extends BaseController
{
    protected $ventas, $temporal_compra, $detalle_venta, $productos;
    public function __construct()
    {
        $this->ventas = new \App\Models\ventasmodel();
        $this->detalle_venta = new \App\Models\detalleventamodel();
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
   

    public function venta()
    {
        return
            view('header')
            . view('ventas/caja')
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
    
}