<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\categoriasmodel;

class Categorias extends BaseController
{
    protected $categorias;
    public function __construct()
    {
        $this->categorias = new categoriasmodel();
    }
    public function index($activo = 1)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorias', 'datos' => $categorias];

        return
            view('header')
            . view('categorias/categorias', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $categorias = $this->categorias->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Categorias eliminadas', 'datos' => $categorias];

        return
            view('header')
            . view('categorias/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar unidad'];
        return
            view('header')
            . view('categorias/nuevo', $data)
            . view('footer');
    }
    public function insertar()
    {
        $this->categorias->save([
            'nombre' => $this->request->getPost('nombre'),
        ]);
        return redirect()->to(base_url('categorias'));
    }
    public function editar($id)
    {
        $unidad = $this->categorias->where('id', $id)->first();
        $data = ['titulo' => 'Editar categoria', 'datos' => $unidad];
        return
            view('header')
            . view('categorias/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        $this->categorias->update($this->request->getPost('id'), [
            'nombre' => $this->request->getPost('nombre'),
        ]);
        return redirect()->to(base_url('categorias'));
    }
    public function eliminar($id)
    {
        $this->categorias->update($id, ['activo' => 0]);
        return redirect()->to(site_url('categorias'));
    }
    public function reingresar($id)
    {
        $this->categorias->update($id, ['activo' => 1]);
        return redirect()->to(site_url('categorias'));
    }
}
