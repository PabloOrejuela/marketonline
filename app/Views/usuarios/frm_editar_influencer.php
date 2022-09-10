<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?= esc($title); ?></h3>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-users"></i>
                    <?= esc($title); ?>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url().'/registrar_influencer';?>" method="post" enctype="multipart/form-data">
                        <?= session()->getFlashdata('error'); ?>
                        <?= csrf_field(); ?>
                        <div class="mb-1 row">
                            <label for="nombre" class="col-sm-2 col-form-label">Nombre: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control"  name="nombre" value="<?= $influencer->nombre; ?>" placeholder="Nombre">
                                <p id="error-message"><?= session('errors.nombre');?> </p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="cedula" class="col-sm-2 col-form-label">Cédula: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="cedula" value="<?= $influencer->cedula; ?>" placeholder="cedula">
                                <p id="error-message"><?= session('errors.cedula');?> </p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="staticEmail2" name="email" value="<?= $influencer->email; ?>" placeholder="email@example.com">
                                <p id="error-message"><?= session('errors.email');?> </p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="telefono" class="col-sm-2 col-form-label">Teléfono: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="telefono" value="<?= $influencer->telefono; ?>" placeholder="0991111234">
                                <p id="error-message"><?= session('errors.telefono');?> </p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="direccion" class="col-sm-2 col-form-label">Pais: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="pais" value="<?= old('pais'); ?>" placeholder="País">
                                <p id="error-message"><?= session('errors.pais');?> </p>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="direccion" class="col-sm-2 col-form-label">Dirección: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="direccion" value="<?= $influencer->direccion; ?>" placeholder="22 Acacia Ave., Rue de L' Morgue">
                                <p id="error-message"><?= session('errors.telefono');?> </p>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="floatingTextarea2" class="form-label">Descripción: </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" placeholder="Descripción" id="floatingTextarea2" name="descripcion" style="height: 100px"> <?= $influencer->descripcion; ?></textarea>
                            </div>
                        </div>
                        <div class="mb-1 row">
                            <label for="formFile" class="form-label">Avatar</label>
                            <div><img src="<?= site_url().'public/uploads/avatars/'.$idusuario.'/'.$influencer->image;?>" class="img-thumbnail" alt="..."></div>
                            <div class="col-sm-6">
                                <input class="form-control" type="file" id="formFile" name="image" value="<?= old('image'); ?>">
                                <p id="error-message"><?= session('errors.image');?> </p>
                            </div>
                        </div>

                        <?= form_hidden('idrol', $idrol);?> 
                        <input type="submit" class="btn btn-outline-secondary" value="Guardar"/>
                    </form>
                </div>
            </div>
        </div>
    </main>
