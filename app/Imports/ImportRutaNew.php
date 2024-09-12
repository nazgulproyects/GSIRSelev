<?php

namespace App\Imports;

use App\Models\RutaNew;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportRutaNew implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Aquí puedes mapear los datos de cada fila del Excel a tu modelo
        return new RutaNew([
            'proveedor_id' => $row['id'],
            // Asigna el resto de los campos
        ]);
    }
}
