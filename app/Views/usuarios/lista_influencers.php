<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?= esc($title); ?></h3>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-regular fa-thumbs-up"></i> 
                </div>
                <div class="card-body" style="width: 800px ;"> 
                    <table class="table table-borderless table-responsive table-hover mt-5" id="datatablesSimple">

                    <?php 
                        //echo '<pre>'.var_export($influencers, true).'</pre>';exit;
                        if (isset($influencers) && $influencers !== NULL) {
                            foreach ($influencers as $key => $value) {
                                
                                echo '<tr class="mb-3">
                                        <td style="width:100px;">
                                            <div class="card" style="width: 10rem;">
                                                <img src="'.site_url() .'public/uploads/avatars/'.$value->idusuario.'/'.$value->image.'" card-img-top" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="card-body">
                                            <h3><a href="'.site_url().'editar_influencer/'.$value->idusuario.'">'.$value->nombre.'</a></h3>
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">'.$value->cedula.'</li>
                                                        <li class="list-group-item">'.$value->email.'</li>
                                                        <li class="list-group-item">'.$value->telefono.'</li>
                                                        <li class="list-group-item"><i class="fa-brands fa-facebook"></i></li>
                                                        <li class="list-group-item"><i class="fa-brands fa-twitter"></i></li>
                                                    </ul>
                                            </div>
                                        </td>
                                    ';
                                
                                echo '</tr>';
                                echo'<tr><td></td></tr>';
                                
                            }
                            //echo '<tr><td>Página renderizada en {elapsed_time} segundos</td></tr>';
                        }else{
                            echo   '<td colspan="14">NO HAY DATOS</td>';  

                        }
                        
                        
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </main>
<script>
    $('#datatablesSimple').DataTable( {
        paging: true ,
        "lengthMenu": [ 3, 5, 10, 15 ],
        language: {
            processing:     "Procesamiento en curso...",
            search:         "Buscar:",
            lengthMenu:     "Listar _MENU_ filas",
            info:           "_START_ al _END_ de _TOTAL_ registros",
            infoEmpty:      "0 a 0 de 0 registros",
            infoFiltered:   "",
            infoPostFix:    "",
            loadingRecords: "Cargando...",
            zeroRecords:    "No hay registros para mostrar",
            emptyTable:     "Mo hay registros que coicidan",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Último"
            },
            aria: {
                sortAscending:  ": activar para ordenar la columna de manera ascendente",
                sortDescending: ": activar para ordenar la columna de manera descendente"
            }
        }
    } );

</script>
