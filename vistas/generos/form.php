<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$tituloFormulario?> Genero</h5>
                            
                            <form method="POST" action="?c=genero&a=Guardar">
                                <div class="form-group">
                                    <input class="form-control" id="id_genero" name="id_genero" type="hidden"
                                        value="<?= $genero->getIdGenero() ?>" />
                                    <label>Nombre:</label>

                                    <input type="text" required class="form-control" id="nombre_genero"
                                        name="nombre_genero" placeholder="Nombre Genero"
                                        value="<?= $genero->getNombreGenero() ?>">

                                </div>
                                <div class="form-group">
                                    <label>Descripcion:</label>

                                    <textarea class="form-control" required id="descripcion" name="descripcion"
                                        rows="3"><?= $genero->getDescripcion() ?></textarea>

                                </div>

                                <a class="btn btn-dark" href="?c=genero">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>