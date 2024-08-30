



<div class="modal fade" id="m_editPermiso{{ $permiso->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content  border-info"> <!-- Agregado modal-info -->
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Editar Permiso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('permisos.update', $permiso->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-form-label">Nombre Permiso: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nombre_permiso_edit" value="{{ $permiso->name }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-info">Cambiar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
