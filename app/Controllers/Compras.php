<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\comprasmodel;

class Compras extends BaseController
{
    protected $compras;
    protected $reglas;
    public function __construct()
    {
        $this->compras = new \App\Models\comprasmodel();
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
    public function insertar()
    {
        if ($this->validate($this->reglas)) {
            $this->compras->save([
                'nombre'       => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
            ]);
            $this->request->getPost('nombre_corto');
            return redirect()->to(base_url('compras'));
        } else {
            $data = ['titulo' => 'Agregar unidad', 'validation' => $this->validator];
            return view('header')
                . view('compras/nuevo', ['titulo' => 'Agregar unidad', 'validation' => $this->validator])
                . view('footer');
        }
        
    }
    public function editar($id, $valid = null)
    {
        $unidad = $this->compras->where('id', $id)->first();
        if ($valid != null) {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad, 'validation' => $valid];
        } else {
            $data = ['titulo' => 'Editar unidad', 'datos' => $unidad];
        }
        return
            view('header')
            . view('compras/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        if ($this->validate($this->reglas)) {
            $this->compras->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre'),
                'nombre_corto' => $this->request->getPost('nombre_corto'),
            ]);
            return redirect()->to(base_url('compras'));
        } else {
            return $this->editar($this->request->getPost('id'), $this->validator);
        }
    }
    public function eliminar($id)
    {
        $this->compras->update($id, ['activo' => 0]);
        return redirect()->to(site_url('compras'));
    }
    public function reingresar($id)
    {
        $this->compras->update($id, ['activo' => 1]);
        return redirect()->to(site_url('compras'));
    }
}
