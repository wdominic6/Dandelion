<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\clientesmodel;

class Clientes extends BaseController
{
    protected $clientes;
    protected $reglas;
    public function __construct()
    {
        $this->clientes = new clientesmodel();
        helper(['form']);
        $this->reglas = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ],
        ];
    }
    public function index($activo = 1)
    {
        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Clientes', 'datos' => $clientes];

        return
            view('header')
            . view('clientes/clientes', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $clientes = $this->clientes->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Clientes eliminados', 'datos' => $clientes];

        return
            view('header')
            . view('clientes/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        $data = ['titulo' => 'Agregar cliente'];
        return
            view('header')
            . view('clientes/nuevo', $data)
            . view('footer');
    }
    public function insertar()
    {
        if ($this->validate($this->reglas)) {
            $this->clientes->save([
                'nombre'       => $this->request->getPost('nombre'),
                'direccion' => $this->request->getPost('direccion'),
                'telefono' => $this->request->getPost('telefono'),
                'correo' => $this->request->getPost('correo'),
            ]);
            return redirect()->to(base_url('/clientes'));
        } else {

            $data = ['titulo' => 'Agregar cliente', 'validation' => $this->validator];

            return view('header')
                . view('clientes/nuevo', $data)
                . view('footer');
        }
    }
    public function editar($id)
    {
        $cliente = $this->clientes->where('id', $id)->first();
        $data = ['titulo' => 'Editar cliente', 'cliente' => $cliente];
        return
            view('header')
            . view('clientes/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        $this->clientes->update($this->request->getPost('id'), [
            'nombre'       => $this->request->getPost('nombre'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'correo' => $this->request->getPost('correo'),
        ]);
        return redirect()->to(base_url('clientes'));
    }
    public function eliminar($id)
    {
        $this->clientes->update($id, ['activo' => 0]);
        return redirect()->to(site_url('clientes'));
    }
    public function reingresar($id)
    {
        $this->clientes->update($id, ['activo' => 1]);
        return redirect()->to(site_url('clientes'));
    }
    public function autocompleteData()
    {
        $returnData = [];
        $valor = $this->request->getGet('term');
        $clientes = $this->clientes
            ->like('nombre', $valor)
            ->where('activo', 1)
            ->findAll();

        if (!empty($clientes)) {
            foreach ($clientes as $row) {
                $returnData[] = [
                    'id' => $row['id'],
                    'label' => $row['nombre'],
                    'value' => $row['nombre'],
                ];
            }
        }

        return $this->response->setJSON($returnData);
    }
}
