<div class="container">
        <div class="row">
            <div class="col-md-12 page-content-container">
                <div class="row mb-3">
                    <div class="col-md-12 d-flex justify-content-center">
                        <h5>Tus productos</h5>
                    </div>
                </div>
                <div class="row">

                    <!--Lista de items-->
                    <div class="col-md-12 cart-items-container mb-2">

                        <?php foreach ($this->ConsultarLibrosCarrito() as $r): ?>
                            <div class="row mt-2">
                                <div class="col-md-2">

                                    <?php if(null !== $r->img) { ?>

                                    <img src="<?= $r->img ?>" alt="imagen" width="150px"/>

                                    <?php } ?>
                                </div>
                                <div class="col-md-5">
                                    <h4><b><?= $r->titulo ?></b></h4>
                                    <br/>
                                    <label><b>Autor:</b> <?= $r->nombre_autor ?></label>
                                    <br/>
                                    <label><b>Genero:</b> <?= $r->nombre_genero ?></label>
                                    <br/>
                                    <label><b>Categoria:</b> <?= $r->nombre_categoria ?></label>
                                </div>
                                <div class="col-md-2 mt-5">
                                    <label>$<?= number_format((doubleval($r->precio) * doubleval($r->cantidad_libro))) ?></label>
                                </div>
                                <div class="col-md-2 mt-5">
                                    <input type="number" value="<?= $r->cantidad_libro ?>" style="width:50px;" min="1"/>
                                </div>
                                <div class="col-md-1 mt-5">
                                    <a class="btn btn-danger text-white" href="?c=carrito&a=EliminarDelCarrito&id=<?= $r->id_libros_carrito ?>"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>                        
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>                        
                            </div>                        

                        <?php endforeach; ?>

                    </div>
                    

                    <!-- <div class="col-md-12 cart-items-container">
                        <div class="row" style="border:0.5px solid;height:135px;">
                            <div class="col-md-6">
                                <label>Producto 1</label>
                            </div>
                        </div>

                        <div class="row" style="border:0.5px solid;height:135px;">
                            <div class="col-md-6">
                                <label>Producto 2</label>
                            </div>
                        </div>

                        <div class="row" style="border:0.5px solid;height:135px;">
                            <div class="col-md-6">
                                <label>Producto 3</label>
                            </div>
                        </div>
                    </div> -->

                    <!--Lista de items-->
                    
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex" style="justify-content: flex-end;">
                        <h3>Total: $<?= number_format($this->totalCarrito) ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                    </div>
                </div>                
                <div class="row">
                    <div class="col-md-12 p-0 mt-2" style="display: flex; justify-content: flex-end;gap:5px;">
                        <a class="btn btn-dark" href="?c=inicio&a=Principal">Volver al catalogo</a>
                        <button class="btn btn-success">Finalizar compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>