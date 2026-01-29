<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card card-outline card-warning shadow-lg border-0">
            <div class="card-header text-center bg-white border-bottom-0 pt-4">
                <h4 class="font-weight-bold text-dark">Editar Noticia</h4>
            </div>
            
            <form action="index.php?controller=Noticias&action=actualizar" method="POST" enctype="multipart/form-data">
                <div class="card-body px-4 pt-2">
                    <input type="hidden" name="id" value="<?= $noticia['not_id'] ?>">

                    <div class="text-center mb-3">
                        <p class="small font-weight-bold text-secondary mb-1">Imagen Actual:</p>
                        <img src="<?= htmlspecialchars($noticia['not_imagen']) ?>" class="img-thumbnail shadow-sm" style="max-height: 150px;">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-secondary small">Cambiar Imagen (Opcional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="imagen" id="imagenInput" accept="image/*">
                            <label class="custom-file-label" for="imagenInput">Seleccionar nuevo archivo...</label>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-secondary small">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" value="<?= $noticia['not_fecha_inicio'] ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-secondary small">Fecha Fin</label>
                            <input type="date" class="form-control" name="fecha_fin" value="<?= $noticia['not_fecha_fin'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-secondary small">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="4" required><?= htmlspecialchars($noticia['not_descripcion']) ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <a href="index.php?controller=Noticias&action=index" class="btn btn-light rounded-pill px-4">Cancelar</a>
                        <button type="submit" class="btn btn-warning text-white font-weight-bold rounded-pill px-5 shadow-sm">
                            Actualizar
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