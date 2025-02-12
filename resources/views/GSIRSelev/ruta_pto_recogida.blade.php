@section('botones_barra_superior')
<a href="/ruta/{{ urlencode($punto_productos_nav[0]->{'No_ ruta'}) }}" style="background-color: white;" class="inline-flex items-center justify-center p-3 rounded-md text-gray-600 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
    <i class="fa-solid fa-chevron-left fa-xl ml-1 mr-1"></i>
</a>

<button style="background-color: white;" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 ml-2" onclick="location.reload()">
    <i class="fa-solid fa-rotate"></i>
</button>
@endsection

<x-app-layout>

    <style>
        .list-container {
            padding-left: 10px;
            padding-right: 10px;
        }

        .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between !important;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-item i {
            color: #666666;
            margin-right: 10px;
        }

        .list-item span {
            color: #666666;
            font-size: 15px;
            margin-right: 10px;
        }

        .list-item b {
            font-size: 16px;
            font-weight: bold;
            margin-left: auto;
        }

        .map-link {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            background-color: #f1f1f1;
            color: #007bff;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            font-weight: bold;
            width: fit-content;
        }

        .map-link:hover {
            background-color: #007bff;
            color: white;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            transform: translateY(-3px);
        }

        .map-icon {
            width: 18px;
            height: 26px;
            margin-left: 10px;
        }

        .contact-card {
            display: flex;
            flex-direction: column;
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: fit-content;
        }

        .producto-card {
            flex-direction: column;
            padding: 10px;
            background-color: red;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 100%;
        }

        .contact-card span {
            font-weight: bold;
            color: #666666;
        }

        .contact-link {
            text-decoration: none;
            color: #007bff;
            font-size: 15px;
            margin-top: 5px;
        }

        .contact-link:hover {
            color: white;
            background-color: #007bff;
            padding: 5px 10px;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        .button-container {
            display: flex;
            width: 100%;
        }

        .button {
            flex: 1;
            background-color: #29aeff;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.5s;
            padding: 15px;
            font-size: 15px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button.active {
            background-color: #0056b3;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .content-section {
            display: none;
        }

        .active {
            display: block;
        }

        .product-card {
            display: flex;
            flex-direction: column;
            padding: 5px;
            background-color: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 5px;
        }

        .product-card span {
            font-weight: bold;
            color: #666666;
            line-height: 1;
        }

        .icon-button {
            background-color: #f1f1f1;
            border-radius: 8px;
            margin-bottom: 10px;
            display: inline-flex;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }
    </style>

    <style>
        .input-wrapper {
            display: flex !important;
            align-items: center !important;
            border: 1px solid #ddd !important;
            border-radius: 10px !important;
            /* Bordes más redondeados */
            padding: 2px 6px !important;
            background-color: #f5f5f5 !important;
            transition: border-color 0.3s ease-in-out !important;
            width: 100% !important;
        }

        .input-wrapper:hover {
            border-color: #79B329 !important;
        }

        .text-label {
            font-size: 14px !important;
            color: #333 !important;
            width: 150px !important;
            /* Ancho fijo para todos los labels */
            margin-right: 16px !important;
            /* Espacio entre el label y el input */
        }

        .text-label_prod {
            font-size: 14px !important;
            color: #333 !important;
            width: 100px !important;
            /* Ancho fijo para todos los labels */
            margin-right: 16px !important;
            /* Espacio entre el label y el input */
        }

        .styled-input {
            border: none !important;
            outline: none !important;
            font-size: 16px !important;
            color: #333 !important;
            padding: 2px 10px !important;
            border-radius: 10px !important;
            background-color: #fff !important;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1) !important;
            transition: background-color 0.3s, box-shadow 0.3s ease !important;
            flex-grow: 1 !important;
            text-align: center;
        }

        .styled-input:focus {
            background-color: #f9f9f9 !important;
            box-shadow: 0 0 8px rgba(121, 179, 41, 0.5) !important;
        }

        .input-units {
            position: absolute;
            right: 0.5rem;
            /* Espaciado desde el borde derecho del input */
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            /* Color del texto (gris elegante) */
            font-size: 0.9rem;
            pointer-events: none;
            /* Evita que el span sea interactivo */
        }

        .btn {
            color: white !important;
            padding: 2px 10px !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: bold !important;
            font-size: 16px !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
            width: 100% !important;
        }
    </style>
    @section('titulo_cabecera', 'Recogida')


    <!-- Aquí están los botones del menú -->
    <div class="button-container">
        <button class="button active" onclick="showSection('recogida')">PUNTO RECOGIDA</button>
        <button class="button" onclick="showSection('productos')">PRODUCTOS</button>
    </div>


    <div class="button-container">
        @if($punto_productos_nav[0]->estado != 'FINALIZADO')
        <b style="width: 300px; background-color: #c6c6c6; padding-left: 10px; display: flex; align-items: center; height: 50px;">{{$punto_productos_nav[0]->{'No_ ruta'} }}: {{ $punto_productos_nav[0]->Nombre }}</b>
        <button class="button" onclick="$('#modalFinalizarRecogida').modal('show');" style="background-color: #001868; height: 50px;"><i class="fa-solid fa-file-signature fa-xl ml-1 mt-1"></i></button>
        @else
        <b style="width: 100%; background-color: #c6c6c6; padding-top: 4px; padding-left: 10px;">{{$punto_productos_nav[0]->{'No_ ruta'} }}: {{ $punto_productos_nav[0]->Nombre }}</b>
        @endif
    </div>

    @if($punto_productos_nav[0]->estado == 'FINALIZADO')
    <div class="button-container" style="text-align: center;">
        <b style="width: 100%; background-color: #40c744; padding-top: 4px; padding-left: 10px; display: inline-block; color: white;">FINALIZADO</b>
    </div>
    @endif

    <!-- Sección de contenido para 'PUNTO RECOGIDA' -->
    <div id="recogida" class="content-section active">
        <div class="list-container" style="width: 100%;">
            <!-- Contenido existente de la lista... -->
            <!-- <div class="list-item">
            <i class="fa-regular fa-note-sticky fa-xl"></i>
            <span>Núm. Aviso</span>
            <b>1067217</b>
            </div> -->

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-file-pdf fa-xl"></i>
                </div>
                <button type="button" class="btn" onclick="modalDocumentos();" style="padding: 0px; width: 100% !important;">
                    <div class="contact-card"><b style="color: #666666;">DOCUMENTOS</b></div>
                </button>
            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-user fa-xl"></i>
                </div>
                <button type="button" class="btn" onclick="modalCliente('{{ $punto_productos_nav[0]->{'No_ ruta'} }}', '{{$punto_productos_nav[0]->{'No_ Proveedor_Cliente'} }}');" style="padding: 0px; width: 100% !important;">
                    <div class="contact-card"><b style="color: #666666;">{{ $punto_productos_nav[0]->Nombre }}</b></div>
                </button>
            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                </div>
                <a href="https://www.google.com/maps/search/?api=1&query={{$punto_productos_nav[0]->C_P_}} {{ urlencode($punto_productos_nav[0]->{'Direccion 1'} )}} {{$punto_productos_nav[0]->Nombre }}" target="_blank" class="map-link" style="width: 100% !important;">
                    {{ $punto_productos_nav[0]->{'Direccion 1'} }}
                    <img src="{{ asset('images/google_icon.png') }}" alt="Google Maps" class="map-icon">
                </a>

            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-regular fa-address-card fa-xl"></i>
                </div>
                <div class="contact-card" style="width: 100% !important;">
                    <span style="font-size: 13px;"><i class="fa-regular fa-user"></i></span>
                    <a href="tel:+123456789" class="contact-link" style="font-size: 13px;"><i class="fa-solid fa-phone"></i>{{ $punto_productos_nav[0]->{'No_ telefono'} }}</a>
                    <span style="font-size: 13px;"><i class="fa-solid fa-envelope"></i></span>
                </div>
            </div>

            <div class="list-item divider">
                <div style="min-width: 40px;">
                    <i class="fa-regular fa-message fa-xl"></i>
                </div>
                <span>{{$punto_productos_nav[0]->{'Observaciones'} }}</span>
            </div>

            <div class="list-item divider">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                </div>
                <span> </span>
                <!-- <button type="button" class="btn ml-2" style="background-color: #dcdcdc;"><i class="fa-solid fa-camera fa-xl" style="color: #5cbfff; margin-right: 0px;"></i></button> -->

            </div>
        </div>
    </div>

    <!-- Sección de contenido para 'PRODUCTOS' -->
    <div id="productos" class="content-section">
        <div class="list-container" style="width: 100%;">
            <!-- Contenido existente de la lista... -->
            <div class="list-item">
                <i class="fa-solid fa-weight-hanging fa-xl"></i>
                <span>Total peso:</span>
                <b id="total_cantidad_productos">{{ $total_cantidad }} KG</b>
            </div>
        </div>

        @foreach($punto_productos_nav as $prod)
        <div @if(auth()->user()->rol == 0 && $punto_productos_nav[0]->estado == 'FINALIZADO') onclick="return false;" style="cursor: not-allowed; pointer-events: none;" @else onclick="editarProducto('{{$prod->{'Descripcion producto'} }}', '{{$prod->{'No_ linea'} }}');" @endif>
            <div class="button-container mb-1">
                <b style="width: 100% !important; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;">{{$prod->{'Descripcion producto'} }}</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;" id="cantidad_linea_{{$prod->{'No_ linea'} }}">{{ $prod->cantidad }} KG</span>
                        </span>
                    </div>
                </b>
            </div>
        </div>
        @endforeach

        <br>

        <div class="button-container mb-1">
            <b style="min-width: 300px; background-color: #c6c6c6; padding-top: 15px; padding-left: 10px;">PRODUCTOS ADICIONALES</b>
            <button class="button" @if(auth()->user()->rol == 0 && $punto_productos_nav[0]->estado == 'FINALIZADO') disabled @else onclick="anyadirProductoAdicional();" @endif style="background-color: #5fc7ff;"><i class="fa-solid fa-plus fa-xl"></i></button>
        </div>

        @foreach($productos_adicionales as $prod_adicional)
        <div @if(auth()->user()->rol == 0 && $punto_productos_nav[0]->estado == 'FINALIZADO') onclick="return false;" style="cursor: not-allowed; pointer-events: none;" @else onclick="editarProductoAdicional('{{ $prod_adicional->id }}', '{{ $prod_adicional->nombre }}', '{{ $prod_adicional->cantidad }}', '{{ $prod_adicional->tipo }}');" @endif>
            <div class="button-container mb-1">
                <b style="min-width: 300px; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;" id="prod_adic_nombre_id_{{ $prod_adicional->id }}">{{ $prod_adicional->nombre }}</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;" id="prod_adic_cantidad_id_{{ $prod_adicional->id }}">{{ $prod_adicional->cantidad }}</span> <span style="color: #666666;">UND</span>
                        </span>
                    </div>
                </b>
                @if($prod_adicional->tipo == 'RECOGER')
                <button class="button" style="background-color: #79B329;"><i class="fa-solid fa-arrow-up fa-xl"></i></button>
                @elseif($prod_adicional->tipo == 'DEJAR')
                <button class="button" style="background-color: #ff5f5f;"><i class="fa-solid fa-arrow-down fa-xl"></i></button>
                @elseif($prod_adicional->tipo == 'ROTURA')
                <button class="button" style="background-color: #8e8e8e;"><i class="fa-solid fa-xmark fa-xl"></i></button>
                @endif
            </div>
        </div>
        @endforeach

    </div>



    <!-- Modal para mostrar los datos del cliente -->
    <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clienteModalLabel"><b>CLIENTE INFO</b></h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="list-item">
                        <i class="fa-regular fa-building fa-xl"></i>
                        <span>Localidad</span>
                        <b id="cli_localidad"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-regular fa-map fa-xl"></i>
                        <span>Provincia</span>
                        <b id="cli_provincia"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-earth-americas fa-xl"></i>
                        <span>Dirección</span>
                        <b id="cli_direccion"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-layer-group fa-xl"></i>
                        <span>Grupo</span>
                        <b id="cli_grupo"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-shop fa-xl"></i>
                        <span>Tienda</span>
                        <b id="cli_tienda"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-sack-dollar fa-xl"></i>
                        <span>Tipo pago</span>
                        <b id="cli_tipo_pago"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-hand-holding-dollar fa-xl"></i>
                        <span>Remuneración</span>
                        <b id="cli_remuneracion"></b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-square-plus fa-xl"></i>
                        <span>Productos Adicionales</span>
                        <b id="cli_prod_adicionales"></b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar los documentos -->
    <div class="modal fade" id="documentosModal" tabindex="-1" role="dialog" aria-labelledby="documentosModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentosModalLabel"><b>DOCUMENTOS</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-item d-flex align-items-center mb-3">
                        <i class="fa-solid fa-file-pdf fa-xl text-danger me-2"></i>

                        <a href="/documento_pdf/di" target="_blank" class="btn btn-primary btn-sm">
                            Traslado de Residuos (DI)
                        </a>
                    </div>
                    <div class="list-item d-flex align-items-center mb-3">
                        <i class="fa-solid fa-file-pdf fa-xl text-danger me-2"></i>
                        <a href="/documento_pdf/ad" target="_blank" class="btn btn-primary btn-sm">
                            Autodeclaración
                        </a>
                    </div>
                    <div class="list-item d-flex align-items-center mb-3">
                        <i class="fa-solid fa-file-pdf fa-xl text-danger me-2"></i>
                        <a href="/documento_pdf/doc_comercial/{{ urlencode($punto_productos_nav[0]->{'No_ ruta'}) }}/{{$punto_recogida_web->id}}" target="_blank" class="btn btn-primary btn-sm">
                            Documento Comercial
                        </a>
                    </div>
                    <div class="list-item d-flex align-items-center mb-3">
                        <i class="fa-solid fa-file-pdf fa-xl text-danger me-2"></i>
                        <button class="btn btn-secondary btn-sm" class="btn btn-primary btn-sm">
                            Carta de Porte Nacional
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal para la firma CLIENTE -->
    <div class="modal fade" id="modalFinalizarRecogida" tabindex="-1" role="dialog" aria-labelledby="modalFinalizarRecogidaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFinalizarRecogidaLabel">Firma del cliente</h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <canvas id="signatureCanvas" style="border: 1px solid black; width: 100%; height: 300px;" width="600" height="300"></canvas>
                    <div class="row align-items-center mt-4 mb-3">
                        <div class="col-auto">
                            <input type="checkbox" id="sinFirmaCheckbox" onclick="toggleTextarea()" />
                            <label for="sinFirmaCheckbox">Sin firma</label>
                        </div>
                        <div class="col">
                            <textarea id="sinFirmaTextarea" class="form-control" rows="3" placeholder="Motivo" disabled></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn mb-1" style="background-color: red; color: white; height: 50px;" id="clearCanvas">Borrar</button>
                    <button type="button" class="btn btn-primary" style="background-color: #17b5ff; height: 50px;" id="confirmarFirmaCliente" onclick="modalFirmaConductor();">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para la firma CONDUCTOR -->
    <div class="modal fade" id="modalFirmaConductor" tabindex="-1" role="dialog" aria-labelledby="modalFirmaConductorLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFirmaConductorLabel">Firma del conductor</h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <canvas id="signatureCanvas2" style="border: 1px solid black; width: 100%; height: 300px;" width="600" height="300"></canvas>
                    <button type="button" class="btn mb-1 mt-3" style="background-color: red; color: white; height: 50px;" id="clearCanvas2">Borrar</button>
                    <button type="button" class="btn btn-primary" style="background-color: #17b5ff; height: 50px;" id="confirmarFirmaConductor" onclick="modalConfirmarCorreo();">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para CONFIRMAR CORREO -->
    <div class="modal fade" id="modalConfirmarCorreo" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarCorreoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarCorreoLabel">Confirmación del correo</h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" name="">
                    </div>
                    <button type="button" class="btn btn-primary mt-3" style="background-color: #17b5ff; height: 50px;" onclick="modalAbrirPDF();">FINALIZAR</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar la cantidad del peso del producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel"><b>CANTIDAD DEL PRODUCTO</b></h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="num_linea_prod" id="num_linea_prod" value="">

                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-wrapper d-flex align-items-center">
                                <label class="form-label text-label_prod me-2 mt-2">Producto</label>
                                <b style="font-size: 12px;" id="desc_prod_cantidad"></b>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1 mt-1">
                        <div class="col-12">
                            <div class="input-wrapper d-flex align-items-center position-relative">
                                <label class="form-label text-label_prod me-2 mt-2">Cantidad</label>
                                <div class="position-relative flex-grow-1">
                                    <input type="text" id="cantidad_producto_input" class="styled-input w-100" name="cantidad_producto_input" value="" autocomplete="off">
                                    <span class="input-units">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-around mt-3">
                        <button type="button" onclick="asignarCantidadProducto();" class="btn btn-sm" style="background-color: #79B329; color: white;"><b>GUARDAR</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para añadir un producto adicional -->
    <div class="modal fade" id="anyadirProdAdicionalModal" tabindex="-1" role="dialog" aria-labelledby="anyadirProdAdicionalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anyadirProdAdicionalModalLabel"><b>NUEVO PRODUCTO ADICIONAL</b></h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <form action="/ruta/nuevo_producto_adicional" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" name="ruta_actual" value="{{$punto_productos_nav[0]->{'No_ ruta'} }}">
                    <input type="hidden" name="punto_rec_actual" value="{{$punto_recogida_web->id}}">

                    <div class="modal-body">
                        <div class="row mb-1">
                            <div class="col-12">
                                <div class="input-wrapper d-flex align-items-center position-relative">
                                    <label class="form-label text-label_prod me-2 mt-2">Producto</label>
                                    <div class="position-relative flex-grow-1">
                                        <select name="nombre_prod_adicional" id="nombre_prod_adicional" class="form-control select2 styled-input w-100" style="width: 250px;">
                                            <option disabled selected>Seleccionar producto</option>
                                            @foreach($lista_prods as $index => $value)
                                            <option value="{{ $index }}">{{ $index }} - {{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 mt-1">
                            <div class="col-12">
                                <div class="input-wrapper d-flex align-items-center position-relative">
                                    <label class="form-label text-label_prod me-2 mt-2">Cantidad</label>
                                    <div class="position-relative flex-grow-1">
                                        <input type="number" step="1" class="styled-input w-100" name="cant_prod_adicional" value="" autocomplete="off">
                                        <span class="input-units">UND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-3 mt-3">
                            <div class="form-check">
                                <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" value="RECOGER" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1"><i class="fa-solid fa-arrow-up ml-2 mr-2" style="color: #79B329;"></i><b style="color: #79B329;">RECOGER</b></label>
                            </div>
                        </div>
                        <div class="row ml-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" value="DEJAR" id="flexRadioDefault2">
                                <label class="form-check-label" for="flexRadioDefault2"><i class="fa-solid fa-arrow-down ml-2 mr-2" style="color: #ff5f5f;"></i><b style="color: #ff5f5f;">DEJAR</b></label>
                            </div>
                        </div>
                        <div class="row ml-3 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" value="ROTURA" id="flexRadioDefault3">
                                <label class="form-check-label" for="flexRadioDefault3"><i class="fa-solid fa-xmark ml-2 mr-2" style="color: #8e8e8e;"></i><b style="color: #8e8e8e;">ROTURA</b></label>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around mt-3">
                            <button type="submit" class="btn btn-sm" style="background-color: #79B329; color: white;"><b>AÑADIR PRODUCTO ADICIONAL</b></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para editar la cantidad del peso del producto -->
    <div class="modal fade" id="editarProductoAdicionalModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoAdicionalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoAdicionalModalLabel"><b>PRODUCTO ADICIONAL INFO</b></h5>
                    <button type="button" class="btn-close" style="padding-bottom: 12px;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <input type="hidden" name="prod_adicional_id_edit" id="prod_adicional_id_edit" value="">
                <div class="modal-body">


                    <div class="row mb-1">
                        <div class="col-12">
                            <div class="input-wrapper d-flex align-items-center position-relative">
                                <label class="form-label text-label_prod me-2 mt-2">Producto</label>
                                <div class="position-relative flex-grow-1">
                                    <select id="nombre_prod_adicional_edit" class="form-control select2 styled-input w-100" style="width: 250px;">
                                        <option disabled selected>Seleccionar producto</option>
                                        @foreach($lista_prods as $index => $value)
                                        <option value="{{ $index }}">{{ $index }} - {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-1 mt-1">
                        <div class="col-12">
                            <div class="input-wrapper d-flex align-items-center position-relative">
                                <label class="form-label text-label_prod me-2 mt-2">Cantidad</label>
                                <div class="position-relative flex-grow-1">
                                    <input type="text" id="cantidad_prod_adicional_edit" class="styled-input w-100" value="" autocomplete="off">
                                    <span class="input-units">UND</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row ml-3 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefaultEdit" id="flexRadioDefaultEdit1">
                            <label class="form-check-label" for="flexRadioDefaultEdit1"><i class="fa-solid fa-arrow-up ml-2 mr-2" style="color: #79B329;"></i><b style="color: #79B329;">RECOGER</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefaultEdit" id="flexRadioDefaultEdit2">
                            <label class="form-check-label" for="flexRadioDefaultEdit2"><i class="fa-solid fa-arrow-down ml-2 mr-2" style="color: #ff5f5f;"></i><b style="color: #ff5f5f;">DEJAR</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefaultEdit" id="flexRadioDefaultEdit3">
                            <label class="form-check-label" for="flexRadioDefaultEdit3"><i class="fa-solid fa-xmark ml-2 mr-2" style="color: #8e8e8e;"></i><b style="color: #8e8e8e;">ROTURA</b></label>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around mt-3">
                        <!-- <div class="icon-button">
                            <i class="fa-solid fa-camera fa-xl" style="color: #666666;"></i>
                        </div> -->
                        <button type="button" class="btn btn-sm" onclick="guardarProdAdicionalEdit();" style="background-color: #79B329; color: white;"><b>GUARDAR</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            canvasFirmaCliente();
            canvasFirmaConductor();
        });

        var canvas;
        var ctx;

        function canvasFirmaCliente() {
            canvas = document.getElementById('signatureCanvas');
            ctx = canvas.getContext('2d');
            var drawing = false;

            function resizeCanvas() {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas(); // Ajustar al cargar

            // Estilo de dibujo
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';

            $('#modalFinalizarRecogida').on('shown.bs.modal', function() {
                resizeCanvas(); // Ajustar el tamaño del canvas al mostrar el modal

                // Eventos de dibujo
                canvas.addEventListener('mousedown', startDrawing);
                canvas.addEventListener('touchstart', startDrawing);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('touchmove', draw);
                canvas.addEventListener('mouseup', stopDrawing);
                canvas.addEventListener('mouseout', stopDrawing);
                canvas.addEventListener('touchend', stopDrawing);
            });

            $('#modalFinalizarRecogida').on('hidden.bs.modal', function() {
                // Elimina eventos al cerrar el modal
                canvas.removeEventListener('mousedown', startDrawing);
                canvas.removeEventListener('touchstart', startDrawing);
                canvas.removeEventListener('mousemove', draw);
                canvas.removeEventListener('touchmove', draw);
                canvas.removeEventListener('mouseup', stopDrawing);
                canvas.removeEventListener('mouseout', stopDrawing);
                canvas.removeEventListener('touchend', stopDrawing);
            });

            // Limpiar canvas
            document.getElementById('clearCanvas').addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });

            function startDrawing(e) {
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(getPositionX(e), getPositionY(e));
                e.preventDefault();
            }

            function draw(e) {
                if (!drawing) return;
                ctx.lineTo(getPositionX(e), getPositionY(e));
                ctx.stroke();
                e.preventDefault();
            }

            function stopDrawing(e) {
                drawing = false;
                e.preventDefault();
            }

            function getPositionX(e) {
                if (e.touches) {
                    return e.touches[0].clientX - canvas.getBoundingClientRect().left;
                }
                return e.clientX - canvas.getBoundingClientRect().left;
            }

            function getPositionY(e) {
                if (e.touches) {
                    return e.touches[0].clientY - canvas.getBoundingClientRect().top;
                }
                return e.clientY - canvas.getBoundingClientRect().top;
            }


            // Guardar firma como imagen
            document.getElementById('confirmarFirmaCliente').addEventListener('click', function() {
                const imageData = canvas.toDataURL('image/png'); // Genera la imagen en base64
                saveSignature(imageData); // Llama a una función para enviarla al servidor
            });

            function saveSignature(imageData) {
                // Realiza una petición Ajax para enviar la imagen al servidor
                $.ajax({
                    url: '/ruta/guardar_firma_cliente/{{ $punto_recogida_web->ruta_id }}', // Ruta del controlador en Laravel
                    type: 'POST',
                    data: {
                        image: imageData,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        console.log('OK');
                    },
                });
            }
        }

        function canvasFirmaConductor() {
            var canvas = document.getElementById('signatureCanvas2');
            var ctx = canvas.getContext('2d');
            var drawing = false;

            function resizeCanvas() {
                canvas.width = canvas.offsetWidth;
                canvas.height = canvas.offsetHeight;
            }
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas(); // Ajustar al cargar

            // Estilo de dibujo
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';

            $('#modalFirmaConductor').on('shown.bs.modal', function() {
                resizeCanvas(); // Ajustar el tamaño del canvas al mostrar el modal

                // Eventos de dibujo
                canvas.addEventListener('mousedown', startDrawing);
                canvas.addEventListener('touchstart', startDrawing);
                canvas.addEventListener('mousemove', draw);
                canvas.addEventListener('touchmove', draw);
                canvas.addEventListener('mouseup', stopDrawing);
                canvas.addEventListener('mouseout', stopDrawing);
                canvas.addEventListener('touchend', stopDrawing);
            });

            $('#modalFirmaConductor').on('hidden.bs.modal', function() {
                // Elimina eventos al cerrar el modal
                canvas.removeEventListener('mousedown', startDrawing);
                canvas.removeEventListener('touchstart', startDrawing);
                canvas.removeEventListener('mousemove', draw);
                canvas.removeEventListener('touchmove', draw);
                canvas.removeEventListener('mouseup', stopDrawing);
                canvas.removeEventListener('mouseout', stopDrawing);
                canvas.removeEventListener('touchend', stopDrawing);
            });

            // Limpiar canvas
            document.getElementById('clearCanvas2').addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });

            function startDrawing(e) {
                drawing = true;
                ctx.beginPath();
                ctx.moveTo(getPositionX(e), getPositionY(e));
                e.preventDefault();
            }

            function draw(e) {
                if (!drawing) return;
                ctx.lineTo(getPositionX(e), getPositionY(e));
                ctx.stroke();
                e.preventDefault();
            }

            function stopDrawing(e) {
                drawing = false;
                e.preventDefault();
            }

            function getPositionX(e) {
                if (e.touches) {
                    return e.touches[0].clientX - canvas.getBoundingClientRect().left;
                }
                return e.clientX - canvas.getBoundingClientRect().left;
            }

            function getPositionY(e) {
                if (e.touches) {
                    return e.touches[0].clientY - canvas.getBoundingClientRect().top;
                }
                return e.clientY - canvas.getBoundingClientRect().top;
            }

            // Guardar firma como imagen
            document.getElementById('confirmarFirmaConductor').addEventListener('click', function() {
                const imageData = canvas.toDataURL('image/png'); // Genera la imagen en base64
                saveSignature(imageData); // Llama a una función para enviarla al servidor
            });

            function saveSignature(imageData) {
                // Realiza una petición Ajax para enviar la imagen al servidor
                $.ajax({
                    url: '/ruta/guardar_firma_conductor/{{ $punto_recogida_web->ruta_id }}', // Ruta del controlador en Laravel
                    type: 'POST',
                    data: {
                        image: imageData,
                        _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(response) {
                        console.log('OK');
                    }
                });
            }

        }

        function showSection(sectionId) {
            // Oculta todas las secciones
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Muestra la sección seleccionada
            document.getElementById(sectionId).classList.add('active');

            // Actualiza el estado de los botones
            const buttons = document.querySelectorAll('.button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Marca el botón activo
            const activeButton = Array.from(buttons).find(button => button.textContent.includes(sectionId === 'recogida' ? 'PUNTO RECOGIDA' : 'PRODUCTOS'));
            activeButton.classList.add('active');
        }

        function modalFirmaConductor() {
            $('#modalFinalizarRecogida').modal('hide');
            $('#modalFirmaConductor').modal('show');
        }

        function modalConfirmarCorreo() {
            $('#modalFirmaConductor').modal('hide');
            $('#modalConfirmarCorreo').modal('show');
        }

        function modalAbrirPDF() {
            $('#modalConfirmarCorreo').modal('hide');

            // Abre el PDF generado por el controlador
            window.open("/gsir_selev/pdf_albaran/{{ $punto_recogida_web->id }}", '_blank');
            setTimeout(function() {
                window.location.href = "/ruta/{{ $punto_productos_nav[0]->{'No_ ruta'} }}";
            }, 2000);
        }

        function editarProducto(descripcion, no_linea) {
            $('#desc_prod_cantidad').text(descripcion);
            $('#num_linea_prod').val(no_linea);
            cantidad_prod = $('#cantidad_linea_' + no_linea).text().split(' ')[0];
            $('#cantidad_producto_input').val(cantidad_prod);
            $('#editarProductoModal').modal('show');
        }

        function toggleTextarea() {

            // Limpiamos el canvas de la firma
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            const checkbox = document.getElementById('sinFirmaCheckbox');
            const textarea = document.getElementById('sinFirmaTextarea');
            textarea.disabled = !checkbox.checked; // Habilitar o deshabilitar el textarea
            if (!checkbox.checked) {
                textarea.value = ''; // Limpiar el textarea si se desactiva el checkbox
            }
        }

        function anyadirProductoAdicional() {

            $('select').select2({
                dropdownParent: $("#anyadirProdAdicionalModal"),
            });

            $('#anyadirProdAdicionalModal').modal('show');
        }

        function editarProductoAdicional(prod_adic_id, nombre, cantidad, tipo) {

            $('select').select2({
                dropdownParent: $("#editarProductoAdicionalModal"),
            });

            nombre_act = $('#prod_adic_nombre_id_' + prod_adic_id).text();
            cantidad_act = $('#prod_adic_cantidad_id_' + prod_adic_id).text();

            $('#prod_adicional_id_edit').val(prod_adic_id);
            $('#nombre_prod_adicional_edit').val(nombre_act).change();
            $('#cantidad_prod_adicional_edit').val(cantidad_act);

            if (tipo === 'RECOGER') {
                document.getElementById('flexRadioDefaultEdit1').checked = true;
            } else if (tipo === 'DEJAR') {
                document.getElementById('flexRadioDefaultEdit2').checked = true;
            } else if (tipo === 'ROTURA') {
                document.getElementById('flexRadioDefaultEdit3').checked = true;
            }


            $('#editarProductoAdicionalModal').modal('show');
        }

        function modalDocumentos() {
            $('#documentosModal').modal('show');
        }

        function modalCliente(cod_ruta, no_prov_cli) {

            $.ajax({
                url: "/ruta/info_cliente",
                type: "POST",
                dataType: 'json',
                async: false,
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    cod_ruta: cod_ruta,
                    no_prov_cli: no_prov_cli
                },
                success: function(data) {
                    console.log(data)
                    $('#cli_localidad').text(data['localidad']);
                    $('#cli_provincia').text(data['provincia']);
                    $('#cli_direccion').text(data['direccion']);
                    $('#cli_grupo').text(data['grupo']);
                    $('#cli_tienda').text(data['tienda']);
                    $('#cli_tipo_pago').text(data['tipo_pago']);
                    $('#cli_remuneracion').text(data['remuneracion']);
                    $('#cli_prod_adicionales').text(data['prod_adicionales']);
                }
            });

            $('#clienteModal').modal('show');
        }

        function asignarCantidadProducto() {

            no_linea = $('#num_linea_prod').val();
            punto_recogida_web_id = '{{$punto_recogida_web->id}}';
            cantidad = $('#cantidad_producto_input').val();
            $.ajax({
                url: "/ruta/asignar_cantidad_producto",
                type: "POST",
                dataType: 'json',
                async: false,
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    no_linea: no_linea,
                    punto_recogida_web_id: punto_recogida_web_id,
                    cantidad: cantidad
                },
                success: function(data) {
                    $('#total_cantidad_productos').text(data + ' KG');
                    swal({
                        title: "¡Éxito!",
                        text: "La cantidad se ha registrado correctamente.",
                        icon: "success",
                        buttons: false, // Oculta los botones
                        timer: 2000 // Muestra el cuadro durante 2 segundos
                    }).then(() => {
                        // Después de que SweetAlert desaparezca
                        $('#editarProductoModal').modal('hide');
                        $('#cantidad_linea_' + no_linea).text(cantidad + ' KG');
                    });


                }
            });

        }

        function guardarProdAdicionalEdit() {

            prod_adicional_id = $('#prod_adicional_id_edit').val();
            nombre = $('#nombre_prod_adicional_edit').val();
            cantidad = $('#cantidad_prod_adicional_edit').val();

            // Obtener el radio button seleccionado
            const selectedRadio = document.querySelector('input[name="flexRadioDefaultEdit"]:checked');
            if (selectedRadio.id == 'flexRadioDefaultEdit1') {
                tipo = 'RECOGER';
            } else if (selectedRadio.id == 'flexRadioDefaultEdit2') {
                tipo = 'DEJAR';
            } else if (selectedRadio.id == 'flexRadioDefaultEdit3') {
                tipo = 'ROTURA';
            }

            $.ajax({
                url: "/ruta/prod_adicional_guardar",
                type: "POST",
                dataType: 'json',
                async: false,
                data: {
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    prod_adicional_id: prod_adicional_id,
                    nombre: nombre,
                    cantidad: cantidad,
                    tipo: tipo
                },
                success: function(data) {
                    swal({
                        title: "¡Éxito!",
                        text: "Se ha guardado correctamente.",
                        icon: "success",
                        buttons: false, // Oculta los botones
                        timer: 2000 // Muestra el cuadro durante 2 segundos
                    }).then(() => {
                        $('#editarProductoAdicionalModal').modal('hide');
                        $('#prod_adic_nombre_id_' + prod_adicional_id).text(nombre);
                        $('#prod_adic_cantidad_id_' + prod_adicional_id).text(cantidad);

                        // De momento reload para que se vean los cambios del color del checkbox
                        location.reload();
                    });
                }
            });

        }
    </script>

</x-app-layout>