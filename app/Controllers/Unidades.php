<?php

namespace App\Controllers;

use App\Controllers\BaseController;

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
}