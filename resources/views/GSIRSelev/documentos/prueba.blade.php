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
            font-size: 11px;
            font-family: Arial, sans-serif;
        }

        /* Margen de 0.5 cm por todos lados */
        @page {
            margin: 0.5cm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #393939;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .titulo {
            text-align: center;
            background-color: #393939;
            color: white;
        }
    </style>
</head>

<body>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="3" class="titulo"><b>DOCUMENTO DE IDENTIFICACIÓN PARA EL TRASLADO DE RESIDUOS (RD 553/2020)</b></td>
            </tr>
            <tr>
                <td rowspan="4" style="width: 50%; text-align: center;">
                    <img src="{{ base_path('public/images/logo_rem.png') }}" alt="Remittel" style="max-width: 50%;">

                </td>
                <td style="width: 25%;"><b>Nº de Notificación Previa</b></td>
                <td style="width: 25%;"></td>
            </tr>
            <tr>
                <td><b>Fecha inicio del traslado</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Nº Documento</b></td>
                <td></td>
            </tr>
            <tr>
                <td><b>Nº albaran transportista</b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="8" class="titulo"><b>INFORMACIÓN RELATIVA AL OPERADOR DEL TRASLADO</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td colspan="2" style="width: 25%; height: 35px;"><b>Nombre/Razón social:</b></td>
                <td colspan="2" style="width: 25%;"><b>NIF:</b></td>
                <td colspan="3" style="width: 35%;"><b>Dirección:</b></td>
                <td style="width: 15%;"><b>CP:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 40px;"><b>Datos de contacto:</b></td>
                <td><b>Municipio</b></td>
                <td><b>Nº Inscripción en el registro:</b></td>
                <td><b>Teléfono</b></td>
                <td><b>Tipo de operador:</b></td>
                <td><b>Provincia:</b></td>
                <td><b>NIMA</b></td>
                <td><b>Correo electrónico:</b></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="8" class="titulo"><b>INFORMACIÓN RELATIVA AL ORIGEN DEL TRASLADO</b></td>
            </tr>
            <tr>
                <td colspan="4" style="width: 50%; text-align: center; font-size: 10px; height: 10px;"><b>Información del centro productor o poseedor del residuo</b></td>
                <td colspan="4" style="width: 50%; text-align: center; font-size: 10px;"><b>Información de la empresa autorizada operaciones tratamiento residuos</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td colspan="2" style="width: 25%; height: 30px;"><b>Nombre/Razón social:</b></td>
                <td colspan="2" style="width: 25%;"><b>NIF:</b></td>
                <td colspan="2" style="width: 25%;"><b>Nombre/Razón social:</b></td>
                <td style="width: 12%;"><b>NIF:</b></td>
                <td style="width: 13%;"><b>Telefono:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 40px;"><b>Nº Inscripción en el registro:</b></td>
                <td><b>Municipio</b></td>
                <td><b>Dirección:</b></td>
                <td><b>Com Autonoma:</b></td>
                <td><b>Nº Inscripción en el registro:</b></td>
                <td><b>Direccion</b></td>
                <td><b>Municipio</b></td>
                <td><b>Correo electrónico:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 40px;"><b>NIMA:</b></td>
                <td><b>Provincia</b></td>
                <td><b></b></td>
                <td><b>CP:</b></td>
                <td><b>Com Autonoma:</b></td>
                <td><b>CP:</b></td>
                <td><b>NIMA</b></td>
                <td><b>Provincia:</b></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="8" class="titulo"><b>INFORMACIÓN RELATIVA AL DESTINO DEL TRASLADO</b></td>
            </tr>
            <tr>
                <td colspan="4" style="width: 50%; text-align: center; font-size: 10px; height: 10px;"><b>Información de la instalación destino</b></td>
                <td colspan="4" style="width: 50%; text-align: center; font-size: 10px;"><b>Información de la empresa autorizada operaciones tratamiento residuos</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td colspan="2" style="width: 25%; height: 40px;"><b>Nombre/Razón social:</b></td>
                <td colspan="2" style="width: 25%;"><b>NIF:</b></td>
                <td style="width: 12%;"><b>Nombre/Razón social:</b></td>
                <td style="width: 13%;"><b>Tipo Gestor:</b></td>
                <td style="width: 12%;"><b>NIF:</b></td>
                <td style="width: 13%;"><b>Telefono:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 40px;"><b>Nº Inscripción en el registro:</b></td>
                <td><b>Municipio</b></td>
                <td><b>Dirección:</b></td>
                <td><b>Com Autonoma:</b></td>
                <td><b>Nº Inscripción en el registro:</b></td>
                <td><b>Direccion</b></td>
                <td><b>Municipio</b></td>
                <td><b>Correo electrónico:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 40px;"><b>NIMA:</b></td>
                <td><b>Provincia</b></td>
                <td><b>Operación de tratamiento:</b></td>
                <td><b>CP:</b></td>
                <td><b>Com Autonoma:</b></td>
                <td><b>CP:</b></td>
                <td><b>NIMA</b></td>
                <td><b>Provincia:</b></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="5" class="titulo"><b>CARACTERISTICAS DEL RESIDUO QUE SE TRASLADA</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td rowspan="2" style="width: 30%;"><b>Código LER:</b></td>
                <td rowspan="2" style="width: 30%;"><b>Descripción del residuo:</b></td>
                <td colspan="3" style="width: 40%; text-align: center;"><b>A rellenar por el origen (Kg)</b></td>
            </tr>
            <tr>
                <td>Peso Total:</td>
                <td>Peso en vacio:</td>
                <td>Peso Neto:</td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="8" class="titulo"><b>TRANSPORTISTA QUE INTERVIENEN EN EL TRASLADO (A rellenar por el transportista las celdas con asterisco)</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td colspan="2" style="width: 25% !important; height: 40px;"><b>Nombre/Razón social:</b></td>
                <td colspan="2" style="width: 25% !important;"><b>Dirección:</b></td>
                <td style="width: 12%;"><b>Municipio:</b></td>
                <td style="width: 13%;"><b>Nº Inscripción en el registro:</b></td>
                <td colspan="2" style="width: 25%;"><b>Correo electrónico:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="width: 12%; height: 30px;"><b>NIF:</b></td>
                <td><b>CP</b></td>
                <td colspan="2"><b>Telefono:</b></td>
                <td><b>Provincia:</b></td>
                <td><b>NIMA:</b></td>
                <td colspan="2"><b>Com Autonoma:</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="height: 30px;"><b>Conductor *:</b></td>
                <td></td>
                <td style="width: 10%;"><b>DNI *:</b></td>
                <td></td>
                <td><b>Matrícula tractora *:</b></td>
                <td></td>
                <td style="width: 15%;"><b>Matrícula Semirremolque *:</b></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="4" class="titulo"><b>ENVASES/PRODUCTOS ADICIONALES</b></td>
            </tr>
            <tr style="vertical-align: top; font-size: 10px;">
                <td style="width: 25%;">
                    <b>Bidones recogidos:</b>
                    <br>
                    <b>Bidones entregados:</b>
                </td>
                <td style="width: 25%;">
                    <b>Filtros acero recogidos:</b>
                    <br>
                    <b>Filtros acero entregados:</b>
                </td>
                <td style="width: 25%;">
                    <b>Filtros carbono recogidos:</b>
                    <br>
                    <b>Filtros carbono entregados:</b>
                </td>
                <td rowspan="2" style="width: 25%;">
                    <b>Otros filtros:</b>
                    <br>
                    <b>Recogidos:</b>
                    <br>
                    <b>Entregados:</b>
                </td>
            </tr>
            <tr style="font-size: 10px;">
                <td><b>Productos Adicionales:</b></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="4" class="titulo"><b>PAGO REALIZADO</b></td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="width: 25%;"><b>Importe:</b></td>
                <td style="width: 25%;"><b>TJ:</b></td>
                <td style="width: 25%;"><b>TR:</b></td>
                <td style="width: 25%;"></td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="5" class="titulo"><b>OTRAS INFORMACIONES</b></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;"><b>A rellenar por el destinatario</b></td>
            </tr>
            <tr>
                <td colspan="5">Fecha de entrega de los residuos:</td>
            </tr>
            <tr style="vertical-align: top;">
                <td rowspan="2" style="width: 15%;">Aceptación del residuo</td>
                <td style="width: 15%; text-align: center;">SI</td>
                <td style="width: 30%;">Fecha de aceptación:</td>
                <td style="width: 20%;">Cantidad recibida:</td>
                <td style="width: 15%"></td>
            </tr>
            <tr>
                <td style="text-align: center;">NO</td>
                <td>Fecha de rechazo:</td>
                <td>Cantidad recibida:</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="5">En caso de rechazo de los residuos, se opta por la devolución a la instalación de origen, indicar la fecha del nuevo traslado:</td>
            </tr>
            <tr>
                <td colspan="5">Indicar si se opta por que sea la autoridad competente de la comunidad autonoma ante la que se presenta el documento de identificación la que remita dicho documento, a la
                    autoridad competente de la comunidad autónoma de origen del traslado</td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: -2px;">
        <tbody>
            <tr>
                <td colspan="4" class="titulo"><b>DECLARACIÓN DE CONFORMIDAD</b></td>
            </tr>
            <tr>
                <td style="width: 25%; text-align: center;"><b>OPERADOR</b></td>
                <td style="width: 25%; text-align: center;"><b>PRODUCTOR</b></td>
                <td style="width: 25%; text-align: center;"><b>TRANSPORTISTA</b></td>
                <td style="width: 25%; text-align: center;"><b>INSTALACIÓN DE TRATAMIENTO</b></td>
            </tr>
            <tr>
                <td style="width: 25%;">
                    Firma y sello
                    <br>
                    <br>
                    <br>
                    Fecha:
                </td>
                <td style="width: 25%;">
                    Firma y sello
                    <br>
                    <br>
                    <br>
                    Fecha:
                </td>
                <td style="width: 25%;">
                    Firma y sello
                    <br>
                    <br>
                    <br>
                    Fecha:
                </td>
                <td style="width: 25%;">
                    Firma y sello
                    <br>
                    <br>
                    <br>
                    Fecha:
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>