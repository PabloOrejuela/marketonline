<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= esc($title); ?></h1>
                        
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-cash-register"></i>
                </div>
                <div class="card-body"> 
                    <table class="table table-bordered table-striped table-hover mt-5" id="datatablesSimple">
                        <thead>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Estado</th>
                            <th>Activar/Desactivar</th>
                            <th>Eliminar</th>
                        </thead>
                    <?php 
                        //echo '<pre>'.var_export($cartera, true).'</pre>';exit;
                        if (isset($influencers) && $influencers !== NULL) {
                            foreach ($influencers as $key => $value) {
                            
                                echo '<tr>
                                        <td>
                                            <img src="'.site_url().'public/uploads/avatars/'.$value->idusuario.'/'.$value->image.'" class="img-thumbnail-sm" alt="foto">
                                        </td>
                                        <td><a href="'.site_url().'cliente_resumen/'.$value->idusuario.'">'.$value->nombre.'</a></td>
                                        <td>'.$value->cedula.'</td>
                                        <td>'.$value->email.'</td>
                                        <td>'.$value->telefono.'</td>
                                    ';
                                    if ($value->status == 1) {
                                        echo '<td style="font-size:1em;text-align:center;"><i class="fa-regular fa-lightbulb"></i> Activo</td>';
                                    }else{
                                        echo '<td style="font-size:1em;text-align:center;"><i class="fa-solid fa-lightbulb"></i> Inactivo</td>';
                                    }
                                echo '<td style="font-size:2em;text-align:center;">
                                        <a href="'.site_url().'usuario_cambiar_estado/'.$value->idusuario.'/'.$value->status.'">
                                            <i class="fa-solid fa-toggle-on"></i>
                                        </a>
                                    </td>';
                                echo '<td style="font-size:2em;text-align:center;">
                                        <a href="'.site_url().'eliminar_usuario/'.$value->idusuario.'">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </td>';
                                echo '</tr>';
                                
                            }
                            echo '<tr><td>Página renderizada en {elapsed_time} segundos</td></tr>';
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
