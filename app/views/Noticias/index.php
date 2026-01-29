<div class="container-fluid">
    
    <div class="row mb-3">
        <div class="col-12 text-right">
            <a href="index.php?controller=Noticias&action=crear" class="btn btn-warning font-weight-bold shadow-sm">
                <i class="fas fa-plus mr-2"></i> Crear Nueva Noticia
            </a>
        </div>
    </div>

    <div class="row">
        <?php if (!empty($noticias)): ?>
            <?php foreach ($noticias as $nota): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card card-outline card-orange h-100 shadow-lg border-0 transition-zoom">
                        
                        <div class="card-img-top-wrapper" style="height: 200px; overflow: hidden; background: #f4f6f9;">
                            <img src="<?= htmlspecialchars($nota['not_imagen']) ?>" 
                                 class="card-img-top" 
                                 alt="Imagen Noticia" 
                                 style="width: 100%; height: 100%; object-fit: cover;"
                                 onerror="this.src='https://via.placeholder.com/400x200?text=Sin+Imagen'">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge badge-light border">
                                    <i class="far fa-calendar-check text-success mr-1"></i> 
                                    Inicio: <?= date('d/m/y', strtotime($nota['not_fecha_inicio'])) ?>
                                </span>
                                <span class="badge badge-light border ml-1">
                                    <i class="far fa-calendar-times text-danger mr-1"></i> 
                                    Fin: <?= date('d/m/y', strtotime($nota['not_fecha_fin'])) ?>
                                </span>
                            </div>

                            <p class="card-text text-muted flex-grow-1">
                                <?= nl2br(htmlspecialchars(substr($nota['not_descripcion'], 0, 100))) ?>...
                            </p>
                        </div>

                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between pb-3">
                            <a href="index.php?controller=Noticias&action=editar&id=<?= $nota['not_id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                            <button onclick="confirmarEliminar(<?= $nota['not_id'] ?>)" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                <i class="fas fa-trash-alt mr-1"></i> Borrar
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-light text-center py-5 shadow-sm">
                    <i class="fas fa-newspaper fa-3x text-orange mb-3" style="opacity: 0.5;"></i>
                    <h5>No hay noticias publicadas</h5>
                    <p class="text-muted">Empieza creando una nueva promoción o aviso para tus clientes.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Borrar noticia?',
            text: "Dejará de ser visible para los clientes.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ffc107', 
            cancelButtonColor: '#343a40',
            confirmButtonText: '<i class="fas fa-trash"></i> Sí, borrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `index.php?controller=Noticias&action=eliminar&id=${id}`;
            }
        })
    }
</script>