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
            width: 20px;
            height: 20px;
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


    @section('titulo_cabecera', 'Recogida')


    <!-- Aquí están los botones del menú -->
    <div class="button-container">
        <button class="button active" onclick="showSection('recogida')">PUNTO RECOGIDA</button>
        <button class="button" onclick="showSection('productos')">PRODUCTOS</button>
    </div>


    <div class="button-container">
        <b style="min-width: 300px; background-color: #c6c6c6; padding-top: 4px; padding-left: 10px;">RDR22/000766: CONSUM, S. COOP. V. (BETXI-Vilavella)</b>
        <button class="button" onclick="$('#modalFinalizarRecogida').modal('show');" style="background-color: #ffc717;"><i class="fa-solid fa-check fa-xl"></i></button>
    </div>


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
                <button type="button" class="btn" data-toggle="modal" data-target="#documentosModal" style="padding: 0px; width: 100% !important;">
                    <div class="contact-card"><b style="color: #666666;">DOCUMENTOS</b></div>
                </button>
            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-user fa-xl"></i>
                </div>
                <button type="button" class="btn" data-toggle="modal" data-target="#clienteModal" style="padding: 0px; width: 100% !important;">
                    <div class="contact-card"><b style="color: #666666;">CONSUM, S COOP. V. (BETXI-Vilavella)</b></div>
                </button>
            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-location-dot fa-xl"></i>
                </div>
                <a href="https://maps.app.goo.gl/Udwj1Jm5LvrXGM1D7" target="_blank" class="map-link" style="width: 100% !important;">
                    C/ Vilavella, S/n
                    <img src="{{ asset('images/google_icon.png') }}" alt="Google Maps" class="map-icon">
                </a>
            </div>

            <div class="list-item">
                <div style="min-width: 40px;">
                    <i class="fa-regular fa-address-card fa-xl"></i>
                </div>
                <div class="contact-card" style="width: 100% !important;">
                    <span style="font-size: 13px;"><i class="fa-regular fa-user"></i>Juan García Pérez</span>
                    <a href="tel:+123456789" class="contact-link" style="font-size: 13px;"><i class="fa-solid fa-phone"></i>+00 123 45 67 89</a>
                    <span style="font-size: 13px;"><i class="fa-solid fa-envelope"></i>juangarpe@gmail.com</span>
                </div>
            </div>

            <div class="list-item divider">
                <div style="min-width: 40px;">
                    <i class="fa-regular fa-message fa-xl"></i>
                </div>
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, excepturi molestiae</span>
            </div>

            <div class="list-item divider">
                <div style="min-width: 40px;">
                    <i class="fa-solid fa-triangle-exclamation fa-xl"></i>
                </div>
                <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, excepturi molestiae</span>
                <button type="button" class="btn ml-2" style="background-color: #dcdcdc;"><i class="fa-solid fa-camera fa-xl" style="color: #5cbfff; margin-right: 0px;"></i></button>

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
                <b>2.250 Kg</b>
            </div>
        </div>

        @foreach($productos as $prod)
        <div onclick="editarProducto();">
            <div class="button-container mb-1">
                <b style="width: 100% !important; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;">{{$prod['desc_prod']}}</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;">{{$prod['peso']}} kg</span>
                        </span>
                    </div>
                </b>
            </div>
        </div>
        @endforeach

        <br>

        <div class="button-container mb-1">
            <b style="min-width: 300px; background-color: #c6c6c6; padding-top: 15px; padding-left: 10px;">PRODUCTOS ADICIONALES</b>
            <button class="button" onclick="anyadirProductoAdicional();" style="background-color: #5fc7ff;"><i class="fa-solid fa-plus fa-xl"></i></button>
        </div>
        <div onclick="editarProductoAdicional();">
            <div class="button-container mb-1">
                <b style="min-width: 300px; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;">FILTRO CARBONO</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;">2 UND</span>
                        </span>
                    </div>
                </b>
                <button class="button" style="background-color: #79B329;"><i class="fa-solid fa-upload fa-xl"></i></button>
            </div>
        </div>
        <div onclick="editarProductoAdicional();">
            <div class="button-container mb-1">
                <b style="min-width: 300px; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;">FILTRO CARBONO</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;">1 UND</span>
                        </span>
                    </div>
                </b>
                <button class="button" style="background-color: #ff5f5f;"><i class="fa-solid fa-download fa-xl"></i></button>
            </div>
        </div>
        <div onclick="editarProductoAdicional();">
            <div class="button-container mb-1">
                <b style="min-width: 300px; background-color: #e5e5e5; padding-top: 4px; padding-left: 10px;">
                    <div>
                        <span style="color: black; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; max-width: 100%; font-size: 13px;">
                            <b class="mr-1">Producto:</b><span style="color: #666666;">FILTRO CARBONO</span>
                        </span>
                    </div>
                    <div>
                        <span style="color: black; font-size: 13px;">
                            <b class="mr-1">Cantidad:</b><span style="color: #666666;">3 UND</span>
                        </span>
                    </div>
                </b>
                <button class="button" style="background-color: #8e8e8e;"><i class="fa-solid fa-xmark fa-xl"></i></button>
            </div>
        </div>

    </div>



    <!-- Modal para mostrar los datos del cliente -->
    <div class="modal fade" id="clienteModal" tabindex="-1" role="dialog" aria-labelledby="clienteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clienteModalLabel"><b>CLIENTE INFO</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-item">
                        <i class="fa-regular fa-building fa-xl"></i>
                        <span>Localidad</span>
                        <b>BETXI</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-regular fa-map fa-xl"></i>
                        <span>Provincia</span>
                        <b>Castellon</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-earth-americas fa-xl"></i>
                        <span>Dirección</span>
                        <b>C/ Vilavella, S/n</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-layer-group fa-xl"></i>
                        <span>Grupo</span>
                        <b>G1</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-shop fa-xl"></i>
                        <span>Tienda</span>
                        <b>T-0401</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-sack-dollar fa-xl"></i>
                        <span>Tipo pago</span>
                        <b>Transferencia</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-hand-holding-dollar fa-xl"></i>
                        <span>Remuneración</span>
                        <b>100 €</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-square-plus fa-xl"></i>
                        <span>Productos Adicionales</span>
                        <b>SI</b>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar los datos del cliente -->
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
                    <div class="list-item">
                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                        <span>DI</span>
                        <b style="color: #007bff;">di.pdf</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                        <span>AD</span>
                        <b style="color: #007bff;">ad.pdf</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                        <span>DR</span>
                        <b style="color: #007bff;">dr.pdf</b>
                    </div>
                    <div class="list-item">
                        <i class="fa-solid fa-file-pdf fa-xl"></i>
                        <span>ALB</span>
                        <b style="color: #007bff;">alb.pdf</b>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="signatureCanvas" style="border: 1px solid black; width: 100%; height: 300px;" width="600" height="300"></canvas>

                    <div class="row align-items-center" style="margin-bottom: 15px;">
                        <div class="col-auto">
                            <input type="checkbox" id="sinFirmaCheckbox" onclick="toggleTextarea()" />
                            <label for="sinFirmaCheckbox">Sin firma</label>
                        </div>
                        <div class="col">
                            <textarea id="sinFirmaTextarea" class="form-control" rows="3" placeholder="Motivo" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="icon-button">
                        <i class="fa-solid fa-camera fa-xl" style="color: #666666;"></i>
                    </div>
                    <button type="button" class="btn btn-danger" id="clearCanvas">Limpiar</button>
                    <button type="button" class="btn btn-primary" style="background-color: #17b5ff;" onclick="modalFirmaConductor();">Confirmar</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="signatureCanvas2" style="border: 1px solid black; width: 100%; height: 300px;" width="600" height="300"></canvas>
                </div>
                <div class="modal-footer">
                    <div class="icon-button">
                        <i class="fa-solid fa-camera fa-xl" style="color: #666666;"></i>
                    </div>
                    <button type="button" class="btn btn-danger" id="clearCanvas2">Limpiar</button>
                    <button type="button" class="btn btn-primary" style="background-color: #17b5ff;" id="clearCanvas" onclick="modalConfirmarCorreo();">Confirmar</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" name="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" style="background-color: #17b5ff;" onclick="modalAbrirPDF();">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar la cantidad del peso del producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel"><b>PRODUCTO INFO</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-item">
                        <span>Producto:</span>
                        <b style="font-size: 12px;">GRASA/HUESO GRAN SUPERFICIE</b>
                    </div>
                    <div class="list-item">
                        <span>Cantidad:</span>
                        <input type="text" style="text-align: right;" class="form-control" name="" value="1000">
                        <span class="ml-2">KG</span>
                    </div>
                    <div class="row d-flex justify-content-around mt-3">
                        <div class="icon-button">
                            <i class="fa-solid fa-camera fa-xl" style="color: #666666;"></i>
                        </div>
                        <button type="button" class="btn btn-success btn-sm"><b>GUARDAR</b></button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-item">
                        <span>Producto:</span>
                        <input type="text" class="form-control" name="" value="">
                    </div>
                    <div class="list-item">
                        <span>Cantidad:</span>
                        <input type="text" style="text-align: right;" class="form-control" name="" value="">
                        <span class="ml-2">UND</span>
                    </div>
                    <div class="row ml-3 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1"><i class="fa-solid fa-upload ml-2 mr-2" style="color: #79B329;"></i><b style="color: #79B329;">RECOGER</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2"><i class="fa-solid fa-download ml-2 mr-2" style="color: #ff5f5f;"></i><b style="color: #ff5f5f;">DEJAR</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3"><i class="fa-solid fa-xmark ml-2 mr-2" style="color: #8e8e8e;"></i><b style="color: #8e8e8e;">ELIMINAR</b></label>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-around mt-3">
                        <button type="button" class="btn btn-success btn-sm"><b>GUARDAR</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar la cantidad del peso del producto -->
    <div class="modal fade" id="editarProductoAdicionalModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoAdicionalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoAdicionalModalLabel"><b>PRODUCTO ADICIONAL INFO</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-item">
                        <span>Producto:</span>
                        <b style="font-size: 12px;">GRASA/HUESO GRAN SUPERFICIE</b>
                    </div>
                    <div class="list-item">
                        <span>Cantidad:</span>
                        <input type="text" class="form-control" style="text-align: right;" name="" value="1">
                        <span class="ml-2">UND</span>
                    </div>
                    <div class="row ml-3 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1"><i class="fa-solid fa-upload ml-2 mr-2" style="color: #79B329;"></i><b style="color: #79B329;">RECOGER</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2"><i class="fa-solid fa-download ml-2 mr-2" style="color: #ff5f5f;"></i><b style="color: #ff5f5f;">DEJAR</b></label>
                        </div>
                    </div>
                    <div class="row ml-3 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" style="transform: scale(1.5);" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                            <label class="form-check-label" for="flexRadioDefault3"><i class="fa-solid fa-xmark ml-2 mr-2" style="color: #8e8e8e;"></i><b style="color: #8e8e8e;">ELIMINAR</b></label>
                        </div>
                    </div>
                    <hr>
                    <div class="row d-flex justify-content-around mt-3">
                        <div class="icon-button">
                            <i class="fa-solid fa-camera fa-xl" style="color: #666666;"></i>
                        </div>
                        <button type="button" class="btn btn-success btn-sm"><b>GUARDAR</b></button>
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
            window.open("/gsir_selev/pdf_albaran/2", '_blank');
        }

        function editarProducto() {
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
            $('#anyadirProdAdicionalModal').modal('show');
        }

        function editarProductoAdicional() {
            $('#editarProductoAdicionalModal').modal('show');
        }
    </script>

</x-app-layout>