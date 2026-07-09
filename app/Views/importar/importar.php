<div class="ui blue segment">

    <h4 class="ui header">1. Seleccione archivo a importar</h4>
    <div class="ui basic segment">
        <form class="ui form" method="post" enctype="multipart/form-data" action="<?= site_url('archivo/subir') ?>" >
            <div class="fields">
                <div class="field">
                    <label>Subir archivo</label>
                    <?php
                        $nombre_archivo = 'checador.csv';
                        $up_dir = 'import/';
                        $url_actual = site_url('importar/') ;
                        $tipo_archivo = 'dat,csv,txt';
                        $nombre_archivo_fs = $up_dir . $nombre_archivo;
                        $nombre_archivo_url = base_url($up_dir . $nombre_archivo);
                    ?>
                        <div class="ui file input">
                            <input type="file" name="userfile">
                        </div>
                        <input type="hidden" name="up_dir" value="<?=$up_dir?>">
                        <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>">
                        <input type="hidden" name="tipo_archivo" value="<?=$tipo_archivo?>">
                        <input type="hidden" name="url_actual" value="<?=$url_actual?>">
                </div>
                <div class="field">
                    <label></label>
                    <button class="ui green button" id="btn_subir">Verificar datos</button>
                </div>
            </div>
        </form>
        <?php if ($error): ?>
            <div class="ui negative mini message transition">
                <i class="close icon"></i>
                <div class="header">
                    Error
                </div>
                <p><?= $error ?></p>
            </div>
        <?php endif ?>
    </div>

    <?php
        $nombre_archivo = 'checador.csv';
        $up_dir = 'import/';
        $url_actual = site_url('importar/') ;
        $nombre_archivo_fs = $up_dir . $nombre_archivo;
        $nombre_archivo_url = base_url($up_dir . $nombre_archivo);
    ?>
    <?php if ( file_exists($nombre_archivo_fs) ): ?>
        <h4 class="ui header">2. Datos que contiene el archivo:</h4>
        <table class="ui unstackable small striped table">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $max_regs = 5;
                    $contador = 0;
                    $file = fopen($nombre_archivo_fs, "r");
                ?>
                <?php while ( ! feof($file) and $contador < $max_regs): ?>
                    <?php
                        $contador += 1 ;
                        $linea = fgetcsv($file, 0 , "\t");
                    ?>
                    <?php if ( $linea and ! is_null($linea[0]) ): ?>
                        <tr>
                            <td><?= $linea[0] ?></td>
                            <td><?= substr($linea[1], 0, strpos($linea[1], ' ')); ?></td>
                            <td><?= substr($linea[1], strpos($linea[1], ' '), strlen($linea[1])); ?></td>
                        </tr>
                    <?php endif ?>
                <?php endwhile ?>
                <?php fclose($file) ?>
            </tbody>
        </table>

        <div class="ui divider"></div>

        <form class="ui form" method="post" action="/archivo/eliminar_recurso" id="frm_eliminar">
            <?php
                $nombre_archivo = 'checador.csv';
                $up_dir = 'import/';
                $url_actual = site_url('importar/') ;

                $mensaje = '¿Eliminar el archivo ' . $nombre_archivo . '?' ;
                $forma = '#frm_eliminar' ;
            ?>
            <input type="hidden" name="up_dir" value="<?=$up_dir?>">
            <input type="hidden" name="id_recurso" value="1">
            <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>">
            <input type="hidden" name="url_actual" value="<?=$url_actual?>">
        </form>

        <h4 class="ui header">3. Finalizar importación</h4>
        <form class="ui form" method="post" enctype="multipart/form-data" action="<?= site_url('importar/guardar') ?>" >
            <?php if ($error): ?>
                <div class="ui negative mini message transition">
                    <i class="close icon"></i>
                    <div class="header">
                        Error
                    </div>
                    <p><?= $error ?></p>
                </div>
            <?php endif ?>
            <div class="ui center aligned basic segment">
                <a href="#" class="ui orange button" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" >Cancelar importación</a>
                <button class="ui primary button">Importar datos</button>
            </div>
        </form>
    <?php endif ?>

</div>
