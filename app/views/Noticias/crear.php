<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card card-outline card-warning shadow-lg border-0">
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <div class="bg-warning rounded-circle d-inline-flex justify-content-center align-items-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                    <i class="fas fa-bullhorn text-white fa-2x"></i>
                </div>
                <h4 class="font-weight-bold text-dark">Publicar Noticia</h4>
            </div>
            
            <form action="index.php?controller=Noticias&action=guardar" method="POST" enctype="multipart/form-data">
                <div class="card-body px-4 pt-2">
                    
                    <div class="form-group">
                        <label class="font-weight-bold text-secondary small">Imagen de Portada</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagenInput" accept="image/*" required>
                            <label class="custom-file-label" for="imagenInput">Seleccionar archivo...</label>
                        </div>
                        <small class="text-muted">Formatos recomendados: JPG, PNG.</small>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-secondary small">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-secondary small">Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-secondary small">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="4" placeholder="Escribe aquí los detalles..." required></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="index.php?controller=Noticias&action=index" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-warning text-white font-weight-bold rounded-pill px-5 shadow-sm">
                            Publicar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e){
        var fileName = document.getElementById("imagenInput").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>