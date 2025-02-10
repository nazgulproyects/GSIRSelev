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
            border: 1px solid #393939;
            text-align: left;
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
    <div style="text-align: center;">
        <img src="{{ base_path('public/images/iscc.webp') }}" alt="Remittel" style="max-width: 35%;">
    </div>

    <span style="text-align: center; font-size: 16px;"><b>Autodeclaración ISCC para puntos de generación de residuos y productos residuales.</b></span>
    <br>
    <br>


    <table>
        <tbody>
            <tr>
                <td colspan="2" class="titulo" style="text-align: center;"><b>Información sobre el punto de generación:</b></td>
            </tr>
            <tr>
                <td style="width: 40%;"><b>Apelido y Nombre</b></td>
                <td style="width: 60%;">Ver anverso</td>
            </tr>
            <tr>
                <td><b>Calle, número</b></td>
                <td>Ver anverso</td>
            </tr>
            <tr>
                <td><b>C.P., localidad</b></td>
                <td>Ver anverso</td>
            </tr>
            <tr>
                <td><b>País</b></td>
                <td>España (Spain)</td>
            </tr>
            <tr>
                <td><b>Número de teléfono</b></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><b>El material entregado consta de los siguientes residuos o productos residuales:</b></td>
            </tr>
            <tr>
                <td colspan="2">UCO(200125)</td>
            </tr>
            <tr>
                <td colspan="2">Nota: Enumere todos los residuos o productos residuales entregados. Identifiquelos claramente e indique los códigos de
                    residuos (si procede) en conformidad con el Reglamento de residuos nacional pertinente, en caso de tener autorización para
                    hacerlo.</td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>
                        La cantidad de residuos y productos residuales generados por los puntos de generación es de
                        <br>
                        diez (10) o más toneladas al mes.
                    </b>
                </td>
            </tr>
            <tr>
                <td style="height: 50px;">
                    <b>
                        Destinatario de los residuos / productos
                        residuales (punto de recogida)

                    </b>
                </td>
                <td>- - Nº Gest. Residuos:</td>
            </tr>
            <tr>
                <td colspan="2"><b>Mediante la firma de la presente autodeclaración, el firmante confirma lo siguiente:</b></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: justify;">
                    <p> 1. El material entregado en el marco de la presente autodeclaración se corresponde con la definición de "residuo" o
                        "producto residual".</p>
                    <p>Un residuo es una sustacia u objeto que el titular desecha o desea o debe desechar, exceptuando las sustancias alteradas o
                        contaminadas intencionadamente para cumplir con la presente definición.</p>
                    <p>Un producto residual es una sustancia que no conforma el producto final elaborado directamente a través de un proceso de
                        producción; no es un objetivo primario del proceso de producción, y el proceso no se ha modificado intencionadamente para
                        su elaboración.</p>
                    <p>2. En el caso de los productos directos de la agricultura, la acuicultura, la pesca y la silvicultura, el material cumple con los
                        requisitos de sostenibilidad relativos a las superficies en conformidad con el art. 29 de la Directiva (UE) 2018/2001 (RED II)</p>
                    <p>3. El material entregado está compuesto únicamente por biomasa, definida como parte biodegradable de productos,
                        residuos y productos residuales de la agricultura de origen biológico (incluyendo sustancias vegetales y animales), de la
                        silvicultura y los sectores económicos relacionados, incluyendo la pesca y la acuicultura, así como parte biodegradable de
                        residuos industriales y de asentamientos.</p>
                    <p>4. Hay disponible documentación sobre las cantidades entregadas.</p>
                    <p>5. Se cumple con la legislación nacional vigente para evitar y gestionar los residuos (por ejemplo, en relación con el
                        transporte, la supervisión, etc.) Si se cuenta con certificados veterinarios, estos deberán indicarse junto con los documentos
                        comerciales.</p>
                    <p>6. El material entregado es generado exclusivamente por el punto de generación.</p>
                    <p>7. Los auditores de los organismos de certificación o de ISCC (dado el caso, acompañados por un representante del punto
                        de recogida) pueden comprobar si los datos indicados en la presente autodeclaración se corresponden con la realidad in situ
                        o contactando con el firmante (por ejemplo, por teléfono). Los auditores de los organismos de certificación pueden estar
                        acompañados de otros auditores que supervisen sus actividades.</p>
                    <p>8. Los datos contenidos en la presente autodeclaración pueden transmitirse al organismo de certificación del punto de
                        recogida y ser comprobados por este y por ISCC. Nota: El organismo de certificación e ISCC tratarán todos los datos
                        contenidos en la presente autodeclaración de manera confidencial.</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>Ver anverso</b></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: center;"><b>Lugar, fecha</b></td>
                <td style="text-align: center;"><b>Firma</b></td>
            </tr>
        </tbody>

    </table>
    <br>
    <p style="text-align: justify;">El caso de conflictos entre la versión en lengua inglesa y la versión traducida del presente documento, se aplicará la versión
        en lengua inglesa, que será vinculante para las partes implicadas en esta autodeclaración. In the event of any conflict
        between the English language versions and the translated version of this document, the English language version shall apply
        and be binding upon the parties involved in this self-declaration.
    </p>
    <br>
    <table style="border-collapse: collapse !important; width: 100% !important; border: 1px solid white !important;">
        <tbody>
            <tr>
                <td style="border: none; text-align: left;">ISCC System GmbH</td>
                <td style="border: none; text-align: right;">Versión 2.0 (del 1 de julio de 2021)</td>
            </tr>
        </tbody>
    </table>




</body>

</html>