<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla en PDF</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            font-size: 12px;
            font-family: Arial, sans-serif;
        }

        /* Margen de 0.5 cm por todos lados */
        @page {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-top: 0.5cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            vertical-align: top;
        }

        th,
        td {
            /* border: 1px solid black; */
            border: none;
            text-align: left;
            height: 17px;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <table>
        <tbody>
            <tr style="vertical-align: middle;">
                <td style="width: 25%; text-align: left; border: none;">
                    <img src="{{ base_path('public/images/logo_selev.png') }}" alt="Selev" style="max-width: 100%;">
                </td>
                <td style="width: 35%; text-align: right; border: none;"><b style="color: red;">DOCUMENTO COMERCIAL</b></td>
                <td style="width: 20%; text-align: right; border: none;"><b>Nº DOCUMENTO</b></td>
                <td style="width: 20%; text-align: right; border: none;"><b>{{$datos_ruta->{'No_ ruta'} }}/{{$datos_ruta->{'No_ Proveedor_Cliente'} }}</b></td>
            </tr>
        </tbody>
    </table>
    <br>

    <b style="display: block; text-align: center;">
        Para el transporte de subproductos animales no destinados al consumo humano, de conformidad con el Reglamento (CE) nº 1069/2009, Reglamento (UE) 142/2011 y Real Decreto 1528/2012
    </b>

    <br>
    <div style="border: 1px solid black; padding: 2px; width: fit-content; margin-bottom: 15px;">
        <b style="font-size: 20px;">DATOS DEL ORIGEN</b>
        <br>
        <br>
        <b>Establecimiento</b>
        <br>
        <table>
            <tbody>
                <tr>
                    <td style="width: 30%;">Nombre/Razón social</td>
                    <td style="width: 30%;">{{$datos_ruta->{'Nombre'} }}</td>
                    <td style="width: 10%;">CIF/NIF</td>
                    <td colspan="3">{{$cif_nif}}</td>
                </tr>
                <tr>
                    <td>Nº de autorización/registro</td>
                    <td colspan="5" style="color: red;">(SANDACH,RGSEA) ES460290000017</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td>{{$datos_ruta->{'Direccion 1'} }}</td>
                    <td>Municipio</td>
                    <td style="width: 10%;">{{$datos_ruta->{'Poblacion'} }}</td>
                    <td style="width: 10%;">C.P.</td>
                    <td style="width: 10%;">{{$datos_ruta->{'C_P_'} }}</td>
                </tr>
                <tr>
                    <td colspan="4">Lugar de recogida (Si no coincide con la dirección)</td>
                    <td>Nº Tienda</td>
                    <td>{{$datos_ruta->{'Nº Tienda'} }}</td>
                </tr>
                <tr>
                    <td>Fecha de Recogida/Expedición</td>
                    <td colspan="5" style="color: red;">{{$fechaActual}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="border: 1px solid black; padding: 2px; width: fit-content;">
        <b>Datos de la carga: Subproductos Categoria 3 Epígrafe (del a al m) Articulo 10 Reglamento 1069/2009</b>
        <table>
            <tbody>
                <tr>
                    <td style="width: 30%;">Descripción</td>
                    <td style="width: 20%;">Peso Estimado</td>
                    <td style="width: 20%;">Especie</td>
                    <td style="width: 30%;">Destino</td>
                </tr>
                @foreach($productos_punto as $prod)
                <tr>
                    <td>{{$prod->nombre}}</td>
                    <td>{{$prod->cantidad}} KG</td>
                    <td>{{$datos_ruta->Especie}}</td>
                    <td>Planta Transformadora</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="border: 1px solid black; padding: 2px; width: fit-content;">
        <b>CONTROL ENVASES</b>
        <table>
            <tbody>
                <tr>
                    <td style="width: 30%;">ENTREGADOS: Nº</td>
                    <td style="width: 70%;">{{$cant_entregados}}</td>
                </tr>
                <tr>
                    <td>RECOGIDOS: Nº</td>
                    <td>{{$cant_recogidos}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <span>El abajo firmante declara que la información descrita en este apartado es correcta y que se han adoptado todas las precauciones necesarias
        para evitar riesgos para la salud pública o animal.</span>
    <p style="color: red;">{{$fechaActual}}</p>
    <p>Nombre y apellidos en mayusculas:</p>

    <div style="border: 1px solid black; padding: 2px; width: fit-content; margin-bottom: 15px;">
        <b style="font-size: 12px;">DATOS DEL TRANSPORTE</b>
        <br>
        <table>
            <tbody>
                <tr>
                    <td style="width: 25%;">Empresa</td>
                    <td colspan="5">{{$datos_empresa_transporte->Name}}</td>
                </tr>
                <tr>
                    <td>Matricula</td>
                    <td colspan="5">{{$vehiculo_ruta->cod_vehiculo}} {{$vehiculo_ruta->remolque_1}}</td>
                </tr>
                <tr>
                    <td>Nº de autorización/registro</td>
                    <td colspan="5" style="color: red;">SANDACH S46230001</td>
                </tr>
                <tr>
                    <td>Nombre conductor</td>
                    <td colspan="2">{{$datos_conductor->Nombre}}</td>
                    <td style="width: 15%;">CIF/NIF</td>
                    <td colspan="2">{{$datos_conductor->DNI}}</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td style="width: 30%;">{{$datos_empresa_transporte->Address}}</td>
                    <td style="width: 10%;">Municipio</td>
                    <td>{{$datos_empresa_transporte->City}}</td>
                    <td style="width: 7%;">C.P.</td>
                    <td style="width: 13%;">{{$datos_empresa_transporte->{'Post Code'} }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <span>El abajo firmante declara que la información descrita en este apartado es correcta y que se han adoptado todas las precauciones necesarias
        para evitar riesgos para la salud pública o animal.</span>
    <p style="color: red;">{{$fechaActual}}</p>
    <p>Nombre y apellidos en mayusculas:</p>

    <div style="border: 1px solid black; padding: 2px; width: fit-content; margin-bottom: 15px;">
        <b style="font-size: 12px;">DATOS DEL DESTINO</b>
        <br>
        <table>
            <tbody>
                <tr>
                    <td style="width: 25%;">Establecimiento</td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td>Nombre/Razón social</td>
                    <td colspan="2">SELEV PET INDUSTRY, S.L.</td>
                    <td style="width: 15%;">CIF/NIF</td>
                    <td colspan="2">B46062071</td>
                </tr>
                <tr>
                    <td>Nº de autorización/registro</td>
                    <td colspan="2" style="color: red;">SANDACH S46230001</td>
                    <td>Actividad</td>
                    <td colspan="2">Planta Transformadora</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td style="width: 30%;">AUTOVIA A-7 KM. 356</td>
                    <td style="width: 10%;">Municipio</td>
                    <td>Silla</td>
                    <td style="width: 5%;">C.P.</td>
                    <td style="width: 15%;">ES-46460</td>
                </tr>
                <tr>
                    <td>Fecha de recepción</td>
                    <td colspan="2"></td>
                    <td>Cantidad recibida</td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <span>El abajo firmante declara que la información descrita en este apartado es correcta y que se han adoptado todas las precauciones necesarias
        para evitar riesgos para la salud pública o animal.</span>
    <p>Nombre y apellidos en mayusculas:</p>

</body>

</html>