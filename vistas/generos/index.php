<div class="container">
    <div class="row">
        <div class="col-md-12 page-content-container">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-success mb-2" href="?c=genero&a=Form">Crear Genero</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Genero</h5>
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
                                            <th scope="row"><?= $r->id_genero ?></th>
                                            <td><?= $r->nombre_genero ?></td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="?c=genero&a=Form&id=<?= $r->id_genero ?>">Editar</a>
                                                <a class="btn btn-danger"
                                                    href="?c=genero&a=Eliminar&id=<?= $r->id_genero ?>">Eliminar</a>
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