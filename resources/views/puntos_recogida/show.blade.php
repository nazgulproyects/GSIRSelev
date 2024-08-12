<x-app-layout>
    @section('rutas')
    <x-nav-link href="{{ route('puntos_recogida.index') }}" :active="request()->routeIs('puntos_recogida.index')">Puntos de recogida</x-nav-link>
    <x-nav-link href="#" active="true">{{$punto_recogida->nombre}}</x-nav-link>
    @endsection
    <div class="mt-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action='/puntos_recogida/update/{{$punto_recogida->id}}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}

                <div class="row d-flex mb-2">
                    <div class="col-6 d-flex justify-content-start">
                        <x-main_title title="{{$punto_recogida->nombre}}" imagen="{{ asset('images/punto_recogida.png') }}" />
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <x-button type="submit">Guardar</x-button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Nombre:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="nombre" class="form-control" value="{{$punto_recogida->nombre}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Latitud:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="latitud" class="form-control" value="{{$punto_recogida->latitud}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Longitud:</x-label>
                            <div class="col-sm-10">
                                <x-input type="text" name="longitud" class="form-control" value="{{$punto_recogida->longitud}}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <x-label class="col-sm-2 col-form-label">Cliente/Proveedor:</x-label>
                            <div class="col-sm-10">
                                <select name="cli_prov_id" class="form-control" id="sel_cli_prov" style="width: 100%;">
                                    <option disabled selected>Seleccionar</option>
                                    @foreach($cli_provs as $cli_prov)
                                    <option value="{{$cli_prov->id}}">{{$cli_prov->nombre}}</option>
                                    @endforeach
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
        $('#sel_cli_prov').val('{{$punto_recogida->cli_prov_id}}').change();
    })
</script>

<!-- MODAL DE CONFIRMACION -->
@include('utils.notificaciones.confirmacion_ok')