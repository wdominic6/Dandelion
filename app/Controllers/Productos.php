<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\productosmodel;
use App\Models\unidadesmodel;
use App\Models\categoriasmodel;

class Productos extends BaseController
{
    protected $productos;
    protected $reglas;
    protected $unidades;
    protected $categorias;
    public function __construct()
    {
        $this->productos = new productosmodel();
        $this->unidades = new unidadesmodel();
        $this->categorias = new categoriasmodel();
        helper(['form']);
        $this->reglas = [
            'codigo'       => ['rules' => 'required|is_unique[productos.codigo]', 'errors' => ['required' => 'El campo {field} es obligatorio.', 'is_unique' => 'El código ya existe.']],
            'nombre'       => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'precio_venta' => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'precio_compra' => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'stock_minimo' => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'inventariable' => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'id_unidad'    => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
            'id_categoria' => ['rules' => 'required', 'errors' => ['required' => 'El campo {field} es obligatorio.']],
        ];
    }
    public function index($activo = 1)
    {
        $productos = $this->productos->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Productos', 'datos' => $productos];

        return
            view('header')
            . view('productos/productos', $data)
            . view('footer');
    }
    public function eliminados($activo = 0)
    {
        $productos = $this->productos->where('activo', $activo)->findAll();
        $data = ['titulo' => 'Productos eliminadas', 'datos' => $productos];

        return
            view('header')
            . view('productos/eliminados', $data)
            . view('footer');
    }

    public function nuevo()
    {
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $data = ['titulo' => 'Agregar producto', 'unidades' => $unidades, 'categorias' => $categorias];
        return
            view('header')
            . view('productos/nuevo', $data)
            . view('footer');
    }
    public function insertar()
    {
        if ($this->validate($this->reglas)) {
            $this->productos->save([
                'codigo'       => $this->request->getPost('codigo'),
                'nombre'       => $this->request->getPost('nombre'),
                'precio_venta' => $this->request->getPost('precio_venta'),
                'precio_compra' => $this->request->getPost('precio_compra'),
                'stock_minimo' => $this->request->getPost('stock_minimo'),
                'inventariable' => $this->request->getPost('inventariable'),
                'id_unidad'    => $this->request->getPost('id_unidad'),
                'id_categoria' => $this->request->getPost('id_categoria'),
            ]);
            return redirect()->to(base_url('/productos'));
        } else {
            $unidades = $this->unidades->where('activo', 1)->findAll();
            $categorias = $this->categorias->where('activo', 1)->findAll();
            $data = ['titulo' => 'Agregar producto', 'unidades' => $unidades, 'categorias' => $categorias, 'validation' => $this->validator];
            
            return view('header')
                . view('productos/nuevo', $data)
                . view('footer');
        }
    }
    public function editar($id)
    {
        $unidades = $this->unidades->where('activo', 1)->findAll();
        $categorias = $this->categorias->where('activo', 1)->findAll();
        $producto = $this->productos->where('id', $id)->first();
        $data = ['titulo' => 'Editar producto', 'unidades' => $unidades, 'categorias' => $categorias, 'producto' => $producto];
        return
            view('header')
            . view('productos/editar', $data)
            . view('footer');
    }
    public function actualizar()
    {
        $this->productos->update($this->request->getPost('id'), [
            'codigo'       => $this->request->getPost('codigo'),
            'nombre'       => $this->request->getPost('nombre'),
            'precio_venta' => $this->request->getPost('precio_venta'),
            'precio_compra' => $this->request->getPost('precio_compra'),
            'stock_minimo' => $this->request->getPost('stock_minimo'),
            'inventariable' => $this->request->getPost('inventariable'),
            'id_unidad'    => $this->request->getPost('id_unidad'),
            'id_categoria' => $this->request->getPost('id_categoria'),
        ]);
        return redirect()->to(base_url('productos'));
    }
    public function eliminar($id)
    {
        $this->productos->update($id, ['activo' => 0]);
        return redirect()->to(site_url('productos'));
    }
    public function reingresar($id)
    {
        $this->productos->update($id, ['activo' => 1]);
        return redirect()->to(site_url('productos'));
    }
    public function buscarPorCodigo($codigo)
    {
        $this->productos->select('*');
        $this->productos->where('codigo', $codigo);
        $this->productos->where('activo', 1);
        $datos = $this->productos->get()->getRow();

        $res['existe'] = false;
        $res['datos'] = '';
        $res['error'] = '';

        if ($datos) {
            $res['datos'] = $datos;
            $res['existe'] = true;
        } else {
            $res['error'] = 'No existe el producto';
            $res['existe'] = false;
        }
        echo json_encode($res);
    }
    public function autocompleteData()
    {
        $returnData = [];
        $valor = $this->request->getGet('term');
        $productos = $this->productos
            ->like('codigo', $valor)
            ->where('activo', 1)
            ->findAll();

        if (!empty($productos)) {
            foreach ($productos as $row) {
                $returnData[] = [
                    'id' => $row['id'],
                    'value' => $row['codigo'],
                    'label' => $row['codigo']. ' - '. $row['nombre'],
                    
                ];
            }
        }

        return $this->response->setJSON($returnData);
    }
}
