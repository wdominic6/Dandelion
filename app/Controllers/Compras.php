<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\comprasmodel;
use App\Models\temporalcompramodel;
use App\Models\detallecompramodel;
use App\Models\productosmodel;

class Compras extends BaseController
{
    protected $compras, $temporal_compra, $detalle_compra, $productos;
    protected $reglas;
    public function __construct()
    {
        $this->compras = new \App\Models\comprasmodel();
        $this->detalle_compra = new \App\Models\detallecompramodel();
        helper(['form']);

    }
    public function index($activo = 1)
    {
        $compras = $this->compras->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $compras];

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
        $total = $this->request->getPost('total');
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
        return redirect()->to(base_url().'/productos');
    }
    
}
