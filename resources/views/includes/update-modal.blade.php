<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel">Editar publicación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" action="{{ route('image.update') }}">
                    @csrf
                    <input hidden name="id" type="text" value="{{$image->id}}">
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" class="form-control" id="description">{{ $image->description }}</textarea>
                    </div>

                    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>