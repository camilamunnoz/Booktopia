<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-success mb-2" href="?c=categoria&a=Form">Crear categoria</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Categorias</h5>
                            <br/>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($this->modelo->Listar() as $r): ?>

                                        <tr>
                                            <th scope="row"><?= $r->id_categoria ?></th>
                                            <td><?= $r->nombre_categoria ?></td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="?c=categoria&a=Form&id=<?= $r->id_categoria ?>">Editar</a>
                                                <a class="btn btn-danger"
                                                    href="?c=categoria&a=Eliminar&id=<?= $r->id_categoria ?>">Eliminar</a>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>