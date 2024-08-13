<!-- resources/views/albaran.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato</title>


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

        .texto-enmarcado {
            border: 1px solid #000;
            padding: 10px;
            display: inline-block;
            font-weight: bold;
            font-size: 11px;
        }
    </style>

</head>

<body>
    <!-- Barra superior negra con texto blanco -->
    <div class="barra-superior">
        <b>CONTRATO C_{{ str_pad($contrato->id, 4, '0', STR_PAD_LEFT) }}</b>
    </div>

    <div class="contenido-albaran">

        <b style="font-size: 14px; background-color: #d3d3d3; padding: 5px 10px; border-radius: 8px;">
            CONTRATO DE SERVICIO DE RECOGIDA DE ACEITES VEGETALES USADOS - Código LER 200125
        </b>

        <br>
        <br>
        <span><b>Nombre comercial</b>________________________________________________________________</span>
        <span><b>Dirección recogida</b>________________________________________________________________</span>
        <span><b>Localidad</b>____________________________________<b>CP</b> ______________
            <b>Provincia</b>__________</span>
        <span><b>Teléfono</b>____________________________<b>E-mail</b> ______________________________________</span>
        <span><b>Nombre fiscal</b>____________________________________________________________________</span>
        <span><b>DNI/CIF</b>_________________________________________________________________________</span>
        <span><b>Dirección Fiscal</b>__________________________________________________________________</span>
        <span><b>Localidad</b>____________________________________<b>CP</b> ______________
            <b>Provincia</b>__________</span>
        <span><b>Pago:Transferencia Bancaria - IBAN</b>_________________________________________________</span>
        <span><b>Precio por bidon (incluye
                IVA)</b>_____________________________<b>Filtros</b>____________________</span>
        <span><b>Número de bidones estimados</b>_________________<b>Frecuencia</b>___________________________</span>
        <br>
        <br>
        <div class="texto-enmarcado">
            De otra parte, la empresa autorizada a la compraventa de residuos: SOLUCIO CIRCULAR, S.L. con CIF B-06895619
            y domicilio fiscal en Camino Alasquer, número 23 Parcela 33, CP 46260 de Alberic, provincia Valencia,
            provista de autorización como
            NEGOCIANTE DE RESIDUOS, número de identificación medioambiental (NIMA) 6801N021cv, Certificado Iscc.
        </div>
        <br>
        <span style="font-size: 10px;">
            <b>L</b>&nbsp;&nbsp;&nbsp;&nbsp; Que la entidad SOLUCIÓ CIRCULAR, S.L. realizará de manera exclusiva la
            recogida y transporte de aceite vegetal usado generado, estando el cliente a informar si desea cancelar el
            presente contrato.
            <br>
            <b>IL</b>&nbsp;&nbsp;&nbsp;&nbsp; Que estando interesado el cliente en que le sea retirado el aceite vegetal
            usado de forma regular por SOLUCIÓ CIRCULAR, S.L. asignado y descrito en el punto nº I del presente contrato
            de gestión y en los periodos que él crea conveniente; y se llevará a efecto mediante las siguientes
            clausulas:
        </span>
        <br>
        <br>
        <span style="font-size: 10px;">
            <b>PRIMERO</b>- SOLUCIÓ CIRCULAR, S.L. con su colaborador de zona asignado prestará el servicio de recogida
            AL
            CLIENTE de forma periódica, sin coste y por un tiempo de duración de UN AÑO a contar desde el día siguiente
            a la firma del presente contrato.
            <br>
            <b>SEGUNDO</b>- SOLUCIÓ CIRCULAR, S.L. entregará unos recipientes homologados de su propiedad en los que se
            almacenará el residuo en las instalaciones del cliente. Los citados recipientes o bidones tienen un valor de
            compensación de 13,00 más IVA, por daños o robo de los mismos. Una vez llenos se retirarán y sustituirán por
            otros iguales o de similares características y se entregará a su vez un justificante de recogida que se
            conservará como documento acreditativo válido antes las Administraciones Públicas de la no realización de
            vertidos por parte de la empresa que genera el residuo entregándolo al gestor autorizado.
            <br>
            <b>TERCERO</b>- El presente contrato de recogida de aceites vegetales usados tiene carácter de exclusividad
            y, por
            tanto, EL CLIENTE se comprometerá mientras se mantenga la vigencia de este a no entregar a ninguna otra
            empresa o profesional los aceites vegetales usados que no sea SOLUCIO CIRCULAR, S.L. En el caso de que no se
            retiren residuos en un plazo de tres meses desde la firma del contrato, SOLUCIO CIRCULAR, S.L se reserva el
            derecho de suspender el presente contrato y notificarlo a los organismos competentes: Sanidad, Ayuntamiento
            y Medio Ambiente.
            <br>
            <b>CUARTO</b>- El formato de bidones gestionados es de 50 kg con retiradas quincenales, mensuales, etc. o a
            convenir entre ambas partes.
            <br>
            <b>QUINTO</b>- El cliente autoriza a la expedición de facturas en su nombre de acuerdo con el artículo 5.2
            del
            Real Decreto 1619/2012. Las mismas serán entregas trimestralmente al cliente en el formato que elija el
            mismo ya sea en correo electrónico o papel.
            <br>
            <b>SEXTO</b>- SOLUCIO CIRCULAR, S.L informa al firmante del presente contrato de que tratarán sus datos
            personales, como responsables del tratamiento, para fines relacionados con el mantenimiento y ejecución del
            presente contrato, por lo que el periodo de conservación de los mismos se limitará únicamente a la duración
            de la relación contractual, sin perjuicio de la conservación de los datos que fuera necesaria posteriormente
            durante el tiempo en que pudieran surgir responsabilidades derivadas del tratamiento, en cumplimiento con la
            normativa vigente en cada momento. La base de legitimación para el tratamiento de los datos personales del
            firmante es, por tanto, la ejecución del presente contrato. El mismo podrá ejercitar su derecho de acceso,
            rectificación, oposición, supresión, portabilidad y limitación del tratamiento dirigiéndose por escrito a
            SOLUCIÓ CIRCULAR, S.L. sita en la localidad de Alberic, provincia Valencia, camino Alasquer no
            23, parcela 33, o mediante correo electrónico a la dirección info@soluciocircular.com
            <br>
            <br>
            Y en prueba de su conformidad, firman el presente documento por duplicado y en un solo efecto, el lugar y
            fecha:
            <br>
            <br>
            En____________________________________,a____________de_______________________de 20________
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            Este contrato no tendrá validez si no se adjuntan los albaranes de recogida del residuo entregados por
            SOLUCIO CIRCULAR, S.L.
            El presente contrato podrá ser anulado de mutuo acuerdo por cualquiera de las partes en caso de
            incumplimiento. A su vez este podrá ser modificado u/o renovado automáticamente a su vencimiento a no ser
            que se acuerde lo contrario en el plazo de 15 días anteriores a su vencimiento con las condiciones que
            establezcan las partes. Así lo conviene, y en prueba de su aceptación y conformidad se extiende y firma el
            presente contrato, por duplicados, en la ciudad y fecha antes indicada.
            <br>
            SOLUCIÓ CIRCULAR, S.L. es responsable del tratamiento de sus datos de conformidad con el GDRP con la
            finalidad de mantener una relación comercial y conservarlos mientras exista un interés mutuo para ello. No
            se comunicarán los datos a terceros. Puede ejercer sus derechos de acceso, rectificación, portabilidad,
            supresión, limitación y oposición en Camino Alasquer, 23, parcela 33, CP 46260 Alberic, provincia Valencia,
            mediante correo electrónico a info@soluciocircular.com y el de reclamación en www.aepd.es

        </span>


    </div>
</body>

</html>