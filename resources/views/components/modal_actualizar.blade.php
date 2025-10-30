<!-- Modal Actualizar Ciudad -->
<div class="modal fade" id="modalActualizar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Actualizar Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formActualizar" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_pais_nombre" class="form-label">País</label>
                            <select class="form-select" id="edit_pais_nombre" name="pais_nombre" required>
                                <option value="">Seleccione un país</option>
                                <!-- Las opciones se cargan via JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="edit_provincia_nombre" class="form-label">Provincia/Estado</label>
                            <input type="text" class="form-control" id="edit_provincia_nombre" name="provincia_nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_ciudad_nombre" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="edit_ciudad_nombre" name="ciudad_nombre" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>