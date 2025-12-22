<?php

namespace App\Models;
use CodeIgniter\Model;

class temporalcompramodel extends Model
{
    protected $table      = 'temporal_compra';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['folio', 'id_producto', 'codigo', 'nombre', 'cantidad', 'precio', 'subtotal'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function porIdProductoCompra($id_product, $folio){
        $this->select('*');
        $this->where('folio', $folio);
        $this->where('id_producto', $id_product);
        $datos = $this->get()->getRow();
        return $datos; 
    }
    public function porCompra($folio){
        $this->select('*');
        $this->where('folio', $folio);
        $datos = $this->findAll();
        return $datos; 
    }
    public function actualizarProductoCompra($id_producto, $folio, $cantidad, $subtotal){
        $this->set('cantidad', $cantidad);
        $this->set('subtotal', $subtotal);
        $this->where('id_producto', $id_producto);
        $this->where('folio', $folio);
        $this->update();
    }
    public function eliminarProductoCompra($id_producto, $folio){
        $this->where('id_producto', $id_producto);
        $this->where('folio', $folio);
        $this->delete();
    }
    public function eliminarCompra($folio){
        $this->where('folio', $folio);
        $this->delete();
    }
}
?>