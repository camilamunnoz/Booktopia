<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$tituloFormulario?> categoria</h5>

                            <form method="POST" action="?c=categoria&a=Guardar">
                                <div class="form-group">
                                    <input class="form-control" id="id_categoria" name="id_categoria" type="hidden"
                                        value="<?= $categoria->getIdCategoria() ?>" />
                                    <label>Nombre:</label>

                                    <input type="text" required class="form-control" id="nombre_categoria"
                                        name="nombre_categoria" placeholder="Nombre categoria"
                                        value="<?= $categoria->getNombreCategoria() ?>">

                                </div>
                                <div class="form-group">
                                    <label>Descripcion:</label>

                                    <textarea class="form-control" required id="descripcion" name="descripcion"
                                        rows="3"><?= $categoria->getDescripcionCategoria() ?></textarea>

                                </div>

                                <a class="btn btn-dark" href="?c=categoria">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>