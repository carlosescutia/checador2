<div class="ui stackable grid container">
    <div class="row">
        <div class="ten wide column">
            <h1 class="ui header">Proceso</h1>
            <h3 class="ui header">Bienvenido <?=$userdata['nom_usuario']?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif ?>
    </div>

    <div class="row">
        <div class="four wide column">
            <div class="ui card">
                <?php
                    $nombre = 'imag' ;
                    $tipo_archivo = 'png';
                    $nombre_archivo = $nombre . '.' . $tipo_archivo;
                    $up_dir = 'imgs/';
                    $url_actual = site_url('proceso') ;
                    $nombre_archivo_fs = $up_dir . $nombre_archivo;
                    $nombre_archivo_url = base_url($up_dir . $nombre_archivo);
                ?>
                <div class="content">
                    <div class="right floated meta">14h</div>
                    Imagen de usuario
                </div>
                <div class="image">
                    <?php if ( file_exists($nombre_archivo_fs) ): ?>
                        <img class="ui image" src="<?= $nombre_archivo_url ?>">
                        <?php $borrado = 'habilitado' ?>
                    <?php else: ?>
                        <img class="ui image" src="<?= base_url('assets/img/image.png') ?>">
                        <?php $borrado = '' ?>
                    <?php endif ?>
                </div>
                <form method="post" enctype="multipart/form-data" action="<?=site_url('archivo/subir')?>" id="frm_subir">
                    <input type="file" class="ui invisible file input" id="invisibleupload1" name="userfile">
                    <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>">
                    <input type="hidden" name="up_dir" value="<?=$up_dir?>">
                    <input type="hidden" name="tipo_archivo" value="<?=$tipo_archivo?>">
                    <input type="hidden" name="url_actual" value="<?=$url_actual?>">
                </form>
                <form method="post" enctype="multipart/form-data" action="<?=site_url('archivo/eliminar')?>" id="frm_eliminar">
                    <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>">
                    <input type="hidden" name="up_dir" value="<?=$up_dir?>">
                    <input type="hidden" name="url_actual" value="<?=$url_actual?>">
                </form>
                <div class="ui icon buttons">
                    <label for="invisibleupload1" class="ui button" id="btn_archivo"><i class="add icon"></i></label>
                    <button class="ui green button" id="btn_subir" form="frm_subir"><i class="upload icon"></i></button>
                    <button class="ui button" id="btn_eliminar"><i class="minus icon"></i></button>
                </div>
            </div>
        </div>

        <div class="ten wide column">
            <table class="ui celled table">
                <thead>
                    <tr><th>Name</th>
                        <th>Age</th>
                        <th>Job</th>
                    </tr></thead>
                <tbody>
                    <tr>
                        <td data-label="Name">James</td>
                        <td data-label="Age">24</td>
                        <td data-label="Job">Engineer</td>
                    </tr>
                    <tr>
                        <td data-label="Name">Jill</td>
                        <td data-label="Age">26</td>
                        <td data-label="Job">Engineer</td>
                    </tr>
                    <tr>
                        <td data-label="Name">
                            <?php
                                $nombre_doc1 = 'documento' ;
                                $tipo_archivo_doc1 = 'pdf';
                                $nombre_archivo_doc1 = $nombre_doc1 . '.' . $tipo_archivo_doc1;
                                $up_dir_doc1 = 'docs/';
                                $url_actual_doc1 = site_url('proceso') ;
                                $nombre_archivo_fs_doc1 = $up_dir_doc1 . $nombre_archivo_doc1;
                                $nombre_archivo_url_doc1 = base_url($up_dir_doc1 . $nombre_archivo_doc1);
                            ?>
                            <?php if ( file_exists($nombre_archivo_fs_doc1) ): ?>
                                <a class="item" href="<?= $nombre_archivo_url_doc1 ?>" target="_blank">Documento</a>
                                <?php $borrado_doc1 = 'habilitado' ?>
                            <?php else: ?>
                                <?php $borrado_doc1 = '' ?>
                            <?php endif ?>
                            <form method="post" enctype="multipart/form-data" action="<?=site_url('archivo/subir')?>" id="frm_subir_doc1">
                                <input type="file" class="ui invisible file input" id="invisibleupload_doc1" name="userfile">
                                <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo_doc1?>">
                                <input type="hidden" name="up_dir" value="<?=$up_dir_doc1?>">
                                <input type="hidden" name="tipo_archivo" value="<?=$tipo_archivo_doc1?>">
                                <input type="hidden" name="url_actual" value="<?=$url_actual_doc1?>">
                            </form>
                            <form method="post" enctype="multipart/form-data" action="<?=site_url('archivo/eliminar')?>" id="frm_eliminar_doc1">
                                <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo_doc1?>">
                                <input type="hidden" name="up_dir" value="<?=$up_dir_doc1?>">
                                <input type="hidden" name="url_actual" value="<?=$url_actual_doc1?>">
                            </form>
                        </td>
                        <td data-label="Age">
                            <div class="ui icon buttons">
                                <label for="invisibleupload_doc1" class="ui button" id="btn_archivo_doc1"><i class="add icon"></i></label>
                                <button class="ui green button" id="btn_subir_doc1" form="frm_subir_doc1"><i class="upload icon"></i></button>
                                <button class="ui button" id="btn_eliminar_doc1"><i class="minus icon"></i></button>
                            </div>
                        </td>
                        <td data-label="Job">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    $(document).ready( function() {
        $('#btn_subir').hide();
        $('#btn_subir_doc1').hide();
    });

    $('#frm_subir').change( function () {
        $('#btn_subir').show(); 
        $('#btn_archivo').hide();
    });

    $('#btn_eliminar').click( function() {
        if ('<?= $borrado ?>' == 'habilitado') {
            confirm_action('Se eliminará <?=$nombre_archivo?> ¿está seguro?', '#frm_eliminar');
        }
    });

    $('#frm_subir_doc1').change( function () {
        $('#btn_subir_doc1').show(); 
        $('#btn_archivo_doc1').hide();
    });

    $('#btn_eliminar_doc1').click( function() {
        if ('<?= $borrado_doc1 ?>' == 'habilitado') {
            confirm_action('Se eliminará <?=$nombre_archivo_doc1?> ¿está seguro?', '#frm_eliminar_doc1');
        }
    });

</script>
