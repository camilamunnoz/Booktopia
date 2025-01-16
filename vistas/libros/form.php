<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?=$tituloFormulario?> Libro</h5>
                            
                            <form method="POST" action="?c=libro&a=Guardar" enctype="multipart/form-data">
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
                                    <label>Genero:</label>
                                    <br/>
                                    
                                    <select class="form-select form-control" id="id_genero" name="id_genero" value="<?= $libro->getIdGenero() ?>">
                                    <?php foreach ($generos as $r): ?>

                                        <option value="<?= $r->id_genero ?>"><?= $r->nombre_genero ?></option>
                                        
                                    <?php endforeach; ?>
                                    </select>

                                    <label>Categoria:</label>
                                    <br/>

                                    <select class="form-select form-control" id="id_categoria" name="id_categoria" value="<?= $libro->getIdCategoria() ?>">
                                    <?php foreach ($categorias as $r): ?>

                                        <option value="<?= $r->id_categoria ?>"><?= $r->nombre_categoria ?></option>
                                        
                                    <?php endforeach; ?>
                                    </select>

                                </div>
                                
                                <div class="form-group">
                                    <label>Formato:</label>
                                    <br/>
                                    <select class="form-select form-control" id="formato" name="formato" value="<?= $libro->getFormato() ?>">
                                        <option value="1">Físico</option>
                                        <option value="2">Digital</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Precio:</label>

                                    <input type="number" required class="form-control" id="precio"
                                        name="precio" placeholder="Precio"
                                        value="<?= $libro->getPrecio() ?>">

                                </div>


                                <div class="form-group">
                                    <label>Sinopsis:</label>

                                    <textarea class="form-control" required id="sinopsis" name="sinopsis"
                                        rows="3"><?= $libro->getSinopsis() ?></textarea>
                                </div>

                                
                                <div class="form-group">
                                    <label>Portada:</label>

                                    <?php if(null !== $libro->getImg()) { ?>

                                        <img src="<?= $libro->getImg() ?>" alt="imagen" width="100px"/>

                                    <?php } ?>

                                    <input type="file" required class="form-control" id="img"
                                        name="img" placeholder="Imagen">

                                    

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