<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$tituloFormulario?> Libro</h5>
                            
                            <form method="POST" action="?c=libro&a=Guardar">
                                <div class="form-group">
                                    <input class="form-control" id="id_libro" name="id_libro" type="hidden"
                                        value="<?= $libro->getIdLibro() ?>" />
                                    <label>Titulo:</label>

                                    <input type="text" required class="form-control" id="titulo"
                                        name="titulo" placeholder="Titulo"
                                        value="<?= $libro->getTitulo() ?>">

                                </div>

                                <div class="form-group">
                                    <label>Autor:</label>

                                    <input type="text" required class="form-control" id="nombre_autor"
                                        name="nombre_autor" placeholder="Nombre Autor"
                                        value="<?= $libro->getNombreAutor() ?>">

                                </div>

                                <div class="form-group">
                                    <label>Sinopsis:</label>

                                    <textarea class="form-control" required id="sinopsis" name="sinopsis"
                                        rows="3"><?= $libro->getSinopsis() ?></textarea>

                                </div>

                                <a class="btn btn-dark" href="?c=libro">Cancelar</a>
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>