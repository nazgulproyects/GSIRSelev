<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('productos.index') }}" :active="request()->routeIs('productos.index')">Productos</x-nav-link>
    <x-nav-link href="#" active="true">{{$producto->codigo}} {{$producto->descripcion}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">


            <form action='/productos/update/{{$producto->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}

                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$producto->codigo}} {{$producto->descripcion}}" imagen="{{ asset('images/productos.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <x-label class="col-sm-5 col-form-label">Código:</x-label>
                            <div class="col-sm-7">
                                <x-input type="text" name="codigo" class="form-control" value="{{ $producto->codigo }}"></x-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-5 col-form-label">Descripción:</x-label>
                            <div class="col-sm-7">
                                <x-input type="text" name="descripcion" class="form-control" value="{{ $producto->descripcion }}"></x-input>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-5 col-form-label">Tipo:</x-label>
                            <div class="col-sm-7">
                                <select name="tipo" id="tipo_select" class="form-control" style="width: 100%;">
                                    <option disabled selected value>Seleccionar empresa</option>
                                    <option value="PRODUCTO">PRODUCTO</option>
                                    <option value="ENVASE">ENVASE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-5 col-form-label">Unidad Medida:</x-label>
                            <div class="col-sm-7">
                                <select name="unidad_medida" id="unidad_medida_select" class="form-control" style="width: 100%;">
                                    <option disabled selected value></option>
                                    <option value="KG">KG</option>
                                    <option value="UDS">UDS</option>
                                    <option value="L">L</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>



<script>
    $(document).ready(function() {

        $('#tipo_select').val('{{$producto->tipo}}').change();
        $('#unidad_medida_select').val('{{$producto->unidad_medida}}').change();
    })
</script>

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')