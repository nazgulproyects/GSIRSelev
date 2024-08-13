<!-- resources/views/albaran.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albarán</title>


    <style>
        /* Eliminar márgenes y padding del html y body */
        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100%;
            width: 100%;
            font-family: 'Arial', sans-serif;
        }

        /* Estilos para la barra superior */
        .barra-superior {
            background-color: #1a1a1a;
            /* Color negro */
            color: #fff;
            /* Color blanco para el texto */
            padding-top: 40px;
            padding-bottom: 40px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            width: 100%;
            /* Ocupa todo el ancho de la pantalla */
            box-sizing: border-box;
            /* Incluye el padding en el ancho total */
        }

        /* Estilo para el contenedor del albarán */
        .contenido-albaran {
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 20px;
            /* Añadir margen a todos los lados */
        }

        /* Estilos generales para las tablas */
        table {
            width: 100%;
            border-collapse: collapse;
            /* Para eliminar los espacios entre celdas */
            margin-bottom: 20px;
            /* Espacio entre tablas */
        }

        /* Estilo para la primera tabla */
        .tabla-una-columna td {
            background-color: #ffffff;
            /* Fondo gris claro */
            padding: 15px;
            border: 1px solid #5a5a5a;
            /* Borde de las celdas */
        }

        /* Estilo para el texto pegado al borde superior de la tabla */
        .texto-superior {
            background-color: #d3d3d3;
            /* Fondo gris */
            padding: 10px;
            font-weight: bold;
            text-align: center;
        }

        /* Estilo para la segunda tabla (5 columnas, varias filas) */
        .tabla-cinco-columnas td {
            padding: 10px;
            border: 1px solid #5a5a5a;
            /* Borde de las celdas */
        }

        /* Estilo para la tercera tabla (2 columnas, 1 fila) */
        .tabla-dos-columnas td {
            padding: 15px;
            border: 1px solid #5a5a5a;
            /* Borde de las celdas */
        }

        /* Estilo para el texto largo debajo de las tablas */
        .texto-largo {
            padding: 20px;
            line-height: 1.6;
            text-align: justify;
            font-size: 13px;
        }

        .salto-pagina {
            page-break-before: always;
            /* Siempre inicia en una nueva página */
        }
    </style>

</head>

<body>
    <!-- Barra superior negra con texto blanco -->
    <div class="barra-superior">
        <b>ALBARÁN ALB_{{ str_pad($albaran->id, 4, '0', STR_PAD_LEFT) }}</b>
    </div>

    <div class="contenido-albaran">
        <!-- Primera tabla con 3 filas y 1 columna -->
        <div class="tabla-superior">
            <div class="texto-superior">JUSTIFICANTE Y CONTRATO DE RETIRADA</div>
            <table class="tabla-una-columna">
                <tr>
                    <td>Fecha</td>
                </tr>
                <tr>
                    <td>Cliente</td>
                </tr>
                <tr>
                    <td>Población</td>
                </tr>
            </table>
        </div>

        <!-- Segunda tabla con 5 columnas y varias filas en blanco -->
        <table class="tabla-cinco-columnas">
            <tr style="background-color: #d3d3d3;">
                <td>CÓD. PRODUCTO</td>
                <td>PRODUCTO</td>
                <td>CANTIDAD</td>
                <td>UNIDADES</td>
            </tr>
            @foreach ($albaran_prods as $alb_prod)
                <tr>
                    <td>{{$alb_prod->producto->codigo}}</td>
                    <td>{{$alb_prod->producto->descripcion}}</td>
                    <td>{{$alb_prod->cantidad}}</td>
                    <td>{{$alb_prod->producto->unidad_medida}}</td>
                </tr>
            @endforeach

        </table>

        <!-- Tercera tabla con 2 columnas y 1 fila -->
        <table class="tabla-dos-columnas">
            <tr>
                <td><b>Observaciones</b>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
                <td><b>Recibí conforme</b>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
            </tr>
        </table>

        <!-- Texto largo debajo de las tablas -->

        <div class="texto-largo">
            <b>CLAUSULAS:</b><br>
            <b>PRIMERO.-</b> El establecimiento autoriza a SOLUCIO CIRCULAR,M S.L. - CIF B06895619 a la expedición de
            facturas en su nombre de acuerdo cno la ley de I.V.A Articulo 164.2 Redacc. L 53/2002 Reglamento de
            facturación ART. 5
            <br>
            <b>SEGUNDO.-</b> SOLUCIÓ CIRCULAR, S.L. entregará unos recipientes homologados de su propiedad en los que se
            almacenará el residuo en las instlaciones del cliente. Los citados recipientes o bidones tienen un valor de
            compensación de 13,00€ más IVA, por daños o robo de los mismos. Una vez llenos se retirarán y sustuirán por
            otros iguales o de similares característifcas y se entregará a su vez un justificante de recogida que se
            conservará como documento acreditativo válido ante las Administraciones Públicas de la no realización de
            vertidos por parte de la empresa que genera el residuo entregándolo al gestor autorizado.
        </div>

        <div class="salto-pagina" style="margin-top: 30px;"></div>
        <b>Autodeclaración ISCC para puntos de origen que produzcan aceite de cocina (UCO)</b>
        <br>
        <br>
        <table class="tabla-cinco-columnas">
            <tr style="background-color: #d3d3d3;">
                <td colspan="2"><b>Información sobre el punto de origen (ej. Restaruante, empresa de catering, etc.)</b>
                </td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td></td>
            </tr>
            <tr>
                <td>Dirección, calle</td>
                <td></td>
            </tr>
            <tr>
                <td>Código postal, ubicación</td>
                <td></td>
            </tr>
            <tr>
                <td>País <br> Número de teléfono </td>
                <td></td>
            </tr>
            <tr>
                <td>La cantidad de UCO producida por el punto de origen es de diez (10)<sup>1</sup> o más toneladas
                    métricas al mes</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">Destinatario del UCO <br> (punto de recogida)</td>
            </tr>
            <tr style="background-color: #d3d3d3;">
                <td colspan="2"><b>Firmando esta autodeclaración, el siganatario confirma lo siguiente:</b></td>
            </tr>
            <tr>
                <td colspan="2">
                    1. El UCO hace referencia al aceite y las grasas de origen vegetal o animal utilizados para cocinar
                    comida destinada al consumo humano. Las entregas de UCo que cubre esta autodeclaración constan
                    íntegramente de UCO y no se mezclar con otros aceites o grasas que no cumplan con la definición de
                    UCO.
                    <br>
                    2. El UCO que cubre esta autodeclaración cumple con la definición de "residuo". Esto significa que
                    el UCO es un material que el punto de origne desecha o pretende o tiene la obligación de desechar, y
                    que el UCO no se ha modificado o contaminado intencionadamente para cumplir con esta definición.
                    <br>
                    3. Hay disponible documentación de las cantidad de UCO entregadas.
                    <br>
                    4. Se cumple con la legistación nacional aplicable en relación con la prevención y la gestión de
                    recuros (por ejemplo, para el transporte, la supervisión, etc.).
                    <br>
                    5. Los auditores de entes de certificación o de ISCC (podrán estar acompañados por un representante
                    del punto de recogida) podrán examinar si lo indicado en esta autodeclaración es correcto in situ o
                    poniéndose en contacto con el signatario (por ejemplo, por teléfono).
                    <br>
                    6. La información contenida en esta autodeclaración podrá transimirse y ser revisada por el ente de
                    certificación del punto de recogida y por iSCC. Nota: El ente de certificación e ISCC mantiene la
                    confidencialidad de todos los datos proporionados en esta autodeclaración.
                </td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td><b>Lugar, fecha</b></td>
                <td><b>Firma</b></td>
            </tr>
        </table>
        <br>
        1 10(diez) toneladas métricas de UCO equivalen a aprox. 11,1 (once coma un) metros cúbicos/11100 (oncemil cien)
        litros/2932 (dos mil novecientos treinta y dos) galones
        <br>
        2 Si esá amrcado este campo, se asume que el UCO producido por el punto de origen es (al menos parcialmente) de
        origen animal (por ejemplo, derivado del uso de tocino , mantequilla, sebo, etc.) y que el punto de recogida no
        puede vender el UCO de este punto de origen como "100% de origen vegetal". Si no está marcado este campo,
        significa que el punto de origen utiliza exclusivamente aceite vegetal (ej. aceite de colza o de girasol) y no
        aceite o grasa de origen animal para cocinar o freír.
        <br>
        Nota: El aceite vegetal...
    </div>
</body>

</html>