<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\unidadesmodel;

class Unidades extends BaseController
{
    protected $unidades;
    public function __construct()
    {
        $this->unidades = new \App\Models\unidadesmodel();
    }
    public function index($activo = 1)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades', 'datos' => $unidades];

        return
            view('header')
            . view('unidades/unidades', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $unidades = $this->unidades->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Unidades eliminadas', 'datos' => $unidades];

        return
            view('header')
            . view('unidades/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar unidad'];
        return
            view('header')
            . view('unidades/nuevo', $data)
            . view('footer');
    }
    public function insertar()
    {
        if (! $this->validate([
            'nombre'       => 'required',
            'nombre_corto' => 'required',
        ])) {
            return view('header')
                . view('unidades/nuevo', ['titulo' => 'Agregar unidad', 'validation' => $this->validator])
                . view('footer');
        }

        $this->unidades->save([
            'nombre'       => $this->request->getPost('nombre'),
            'nombre_corto' => $this->request->getPost('nombre_corto'),
        ]);
        return redirect()->to(base_url('unidades'));
    }
    public function editar($id)
    {
        $unidad = $this->unidades->where('id', $id)->first();
        $data = ['titulo' => 'Editar unidad', 'datos' => $unidad];
        return
            view('header')
            . view('unidades/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        $this->unidades->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'),
            'nombre_corto' => $this->request->getPost('nombre_corto'),
        ]);
        return redirect()->to(base_url('unidades'));
    }
    public function eliminar($id)
    {
        $this->unidades->update($id, ['activo' => 0]);
        return redirect()->to(site_url('unidades'));
    }
    public function reingresar($id)
    {
        $this->unidades->update($id, ['activo' => 1]);
        return redirect()->to(site_url('unidades'));
    }
}
