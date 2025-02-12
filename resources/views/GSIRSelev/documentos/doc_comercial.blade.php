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
                <td style="width: 20%; text-align: right; border: none;"><b>RD25/001132/CL0210</b></td>
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
                    <td style="width: 30%;">DOLZ ESPAÑA,S.L.</td>
                    <td style="width: 10%;">CIF/NIF</td>
                    <td colspan="3">B46739579</td>
                </tr>
                <tr>
                    <td>Nº de autorización/registro</td>
                    <td colspan="5">(SANDACH,RGSEA) ES460290000017</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td>Pol. Ind. Cotes B C/Corretgers, I</td>
                    <td>Municipio</td>
                    <td style="width: 10%;">Algemesi</td>
                    <td style="width: 10%;">C.P.</td>
                    <td style="width: 10%;">ES-46680</td>
                </tr>
                <tr>
                    <td colspan="4">Lugar de recogida (Si no coincide con la dirección)</td>
                    <td>Nº Tienda</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Fecha de Recogida/Expedición</td>
                    <td colspan="5">4 de febrero de 2025</td>
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
                <tr>
                    <td>SANGRE LÍQUIDA DE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>PLUMA</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>TRIPA DE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>HUESO DE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>PATAS DE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>CARCASAS DE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
                <tr>
                    <td>SUBP. DESPIECE AVE</td>
                    <td>1000 KG</td>
                    <td>Avícola</td>
                    <td>Planta Transformadora</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="border: 1px solid black; padding: 2px; width: fit-content;">
        <b>CONTROL ENVASES</b>
        <table>
            <tbody>
                <tr>
                    <td style="width: 30%;">ENTREGADOS: Nº</td>
                    <td style="width: 70%;"></td>
                </tr>
                <tr>
                    <td>RECOGIDOS: Nº</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <span>El abajo firmante declara que la información descrita en este apartado es correcta y que se han adoptado todas las precauciones necesarias
        para evitar riesgos para la salud pública o animal.</span>
    <p>4 de febrero de 2025</p>
    <p>Nombre y apellidos en mayusculas:</p>

    <div style="border: 1px solid black; padding: 2px; width: fit-content; margin-bottom: 15px;">
        <b style="font-size: 12px;">DATOS DEL TRANSPORTE</b>
        <br>
        <table>
            <tbody>
                <tr>
                    <td style="width: 25%;">Empresa</td>
                    <td colspan="5">SELEV Pet Industry, S.L.U.</td>
                </tr>
                <tr>
                    <td>Matricula</td>
                    <td colspan="5">9234KNH CO-5644</td>
                </tr>
                <tr>
                    <td>Nº de autorización/registro</td>
                    <td colspan="5">SANDACH S46230001</td>
                </tr>
                <tr>
                    <td>Nombre conductor</td>
                    <td colspan="2">JUAN CARLOS LUCENA MAJON</td>
                    <td style="width: 15%;">CIF/NIF</td>
                    <td colspan="2">48437212-V</td>
                </tr>
                <tr>
                    <td>Dirección</td>
                    <td style="width: 30%;">Autovía A-7 Km. 356</td>
                    <td style="width: 10%;">Municipio</td>
                    <td>Silla</td>
                    <td style="width: 7%;">C.P.</td>
                    <td style="width: 13%;">ES-46460</td>
                </tr>
            </tbody>
        </table>
    </div>

    <span>El abajo firmante declara que la información descrita en este apartado es correcta y que se han adoptado todas las precauciones necesarias
        para evitar riesgos para la salud pública o animal.</span>
    <p>4 de febrero de 2025</p>
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
                    <td colspan="2">SANDACH S46230001</td>
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