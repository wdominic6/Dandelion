<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $db = \Config\Database::connect();
        $today = date('Y-m-d');
        $startDate = date('Y-m-d 00:00:00', strtotime('-6 days'));

        $ventasHoy = $db->table('ventas')
            ->selectSum('total', 'total')
            ->where('activo', 1)
            ->where('DATE(fecha_creacion)', $today)
            ->get()
            ->getRowArray();

        $ventas_hoy_total = (float) ($ventasHoy['total'] ?? 0);

        $ordenes_hoy = $db->table('ventas')
            ->where('activo', 1)
            ->where('DATE(fecha_creacion)', $today)
            ->countAllResults();

        $clientes_activos = $db->table('clientes')
            ->where('activo', 1)
            ->countAllResults();

        $productos_bajos = $db->table('productos')
            ->where('inventariable', 1)
            ->where('activo', 1)
            ->where('existencias <= stock_minimo', null, false)
            ->countAllResults();

        $ventasPorDia = $db->table('ventas')
            ->select('DATE(fecha_creacion) as fecha', false)
            ->selectSum('total', 'total')
            ->where('activo', 1)
            ->where('fecha_creacion >=', $startDate)
            ->groupBy('DATE(fecha_creacion)')
            ->orderBy('fecha', 'ASC')
            ->get()
            ->getResultArray();

        $ventasMap = [];
        foreach ($ventasPorDia as $row) {
            $ventasMap[$row['fecha']] = (float) $row['total'];
        }

        $ventas_chart_labels = [];
        $ventas_chart_data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime('-' . $i . ' days'));
            $ventas_chart_labels[] = date('d/m', strtotime($date));
            $ventas_chart_data[] = $ventasMap[$date] ?? 0;
        }

        $ventas_recientes = $db->table('ventas v')
            ->select('v.folio, v.total, v.forma_pago, v.fecha_creacion, c.nombre as cliente')
            ->join('clientes c', 'c.id = v.id_cliente', 'left')
            ->where('v.activo', 1)
            ->orderBy('v.fecha_creacion', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $inventario_bajo = $db->table('productos')
            ->select('nombre, existencias')
            ->where('inventariable', 1)
            ->where('activo', 1)
            ->where('existencias <= stock_minimo', null, false)
            ->orderBy('existencias', 'ASC')
            ->limit(4)
            ->get()
            ->getResultArray();

        $top_productos = $db->table('detalle_venta')
            ->select('nombre, SUM(cantidad) as unidades', false)
            ->groupBy('nombre')
            ->orderBy('unidades', 'DESC')
            ->limit(4)
            ->get()
            ->getResultArray();

        $data = [
            'ventas_hoy_total' => $ventas_hoy_total,
            'ordenes_hoy' => $ordenes_hoy,
            'clientes_activos' => $clientes_activos,
            'productos_bajos' => $productos_bajos,
            'ventas_chart_labels' => $ventas_chart_labels,
            'ventas_chart_data' => $ventas_chart_data,
            'ventas_recientes' => $ventas_recientes,
            'inventario_bajo' => $inventario_bajo,
            'top_productos' => $top_productos,
        ];

        return view('header')
            . view('dashboard', $data)
            . view('footer');
    }
}
