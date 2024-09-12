<?php

namespace App\Imports;

use App\Models\RutaNew;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportRutaNew implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    public function model(array $row)
    {

        // Si las primeras columnas están vacías (por ejemplo 'id' y 'proveedor'), omitir la fila
        if (empty($row['id']) && empty($row['proveedor'])) {
            return null; // Saltar la fila
        }

        // Aquí puedes mapear los datos de cada fila del Excel a tu modelo
        return new RutaNew([
            'proveedor_id' => $row['id'],
            'fecha_retirada' => $row['fecha_retirada'],
            'proveedor' => $row['proveedor'],
            'cif' => $row['cif'],
            'email' => $row['email'],
            'poblacion' => $row['poblacion'],
            'provincia_pais' => $row['provinciapais'],
            'trabajador' => $row['trabajador'],
            'tipo' => $row['tipo'],
            'grupo' => $row['grupo'],
            'bidones' => $row['bidones'],
            'garrafas' => $row['garrafas'],
            'litros' => $row['litros'],
            'kilos' => $row['kilos'],
            'total_kilos' => $row['total_kilos'],
            'residuo' => $row['residuo'],
            'importe' => $row['importe'],
            'forma_pago' => $row['forma_de_pago'],
            'suministro' => $row['suministro'],
            'deposito' => $row['deposito'],
        ]);
    }
}
