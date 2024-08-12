<div class="modal" tabindex="-1" role="dialog" id="modalEliminar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="mt-2 ml-4">
                <div style="position: relative; display: inline-block; margin-right: 10px;">
                    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); border-radius: 50%; background-color: #FEE2E1; width: 2em; height: 2em; opacity: 0.5;"></div>
                    <i class="fa-solid fa-triangle-exclamation" style="color: #E32928; position: relative; z-index: 1; font-size: 1.5em;"></i>
                </div>
                <span>Eliminar</span>
            </div>
            <form action='{{ $metodo }}' method="POST" enctype="multipart/form-data" class="form-horizontal">
                {{ csrf_field() }}
                <input type="hidden" name="id_eliminar" id="id_eliminar" value="">
                <div class="modal-body">
                    <span>
                        @isset($texto)
                        {{ $texto }}
                        @else
                        ¿Estás seguro que quieres eliminar esta fila?
                        @endisset
                    </span>
                </div>
                <div class="modal-footer" style="background-color: #F4F4F6;">
                    <div class="row-3 d-flex justify-content-end">
                        <x-secondary-button onclick="$('#modalEliminar').modal('hide');">Cancelar</x-secondary-button>
                        <x-danger-button type="submit" style="margin-left: 10px !important;">Eliminar</x-danger-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function eliminarFila(id_eliminar) {
        $('#id_eliminar').val(id_eliminar);
        $('#modalEliminar').modal('show');
    }
</script>