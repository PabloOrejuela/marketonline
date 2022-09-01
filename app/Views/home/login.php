<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-5">                        
            
                <div id="wrap">
                    <div class="row g-2">
                        <div class="col-12 mt-5">
                            <div class="p-3 border bg-cyan" id="form-login">
                            <?= session()->getFlashdata('error'); ?>
                                <h4 class="mb-3"><?= esc($title); ?></h4>
                                
                                <form action="<?php echo base_url().'/validate_credentials';?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="mb-3 row">
                                        <label for="user" class="col-sm-3 mr-10 col-form-label" id="label-login">Usuario:</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="form-control" name="user" placeholder="usuario" required>
                                        </div>
                                        <p id="error-message"><?= session('errors.user');?> </p>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="password" class="col-sm-3 mr-10 col-form-label" id="label-login" >Contraseña:</label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" id="form-control" name="password" placeholder="****" required>
                                        </div>
                                        <p id="error-message"><?= session('errors.password');?> </p>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-secondary" value="Enviar" id="btn-login">Enviar</button>
                                    </div>
                                </form>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </main>
</div>