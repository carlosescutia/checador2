<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar recurso
                        <button class="ui right floated primary button" type="submit" form="frm_recurso">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/recurso/guardar" id="frm_recurso">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_recurso" id="nom_recurso" value="<?=$recurso['nom_recurso']?>">
                            </div>
                            <div class="four wide field" id='fld_url'>
                                <label>Url</label>
                                <input type="text" name="url" id="url" value="<?=$recurso['url']?>">
                            </div>
                            <div class="four wide field">
                                <label>Activo</label>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="activo" id="activo" value="1" <?= ($recurso['activo'] == '1') ? 'checked' : '' ?> >
                                    <label></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_recurso" id="id_recurso" value="<?=$recurso['id_recurso']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
                <form class="ui form" method="post" action="/archivo/eliminar_recurso" id="frm_eliminar">
                    <?php
                    $nombre_archivo = $recurso['archivo'];
                    $up_dir = 'recs/';
                    $url_actual = site_url('recurso/detalle/') . $recurso['id_recurso'] ;

                    $mensaje = '¿Eliminar el archivo ' . $recurso['archivo'] . '?' ;
                    $forma = '#frm_eliminar' ;
                    ?>
                    <input type="hidden" name="up_dir" value="<?=$up_dir?>">
                    <input type="hidden" name="id_recurso" value="<?=$recurso['id_recurso']?>">
                    <input type="hidden" name="nombre_archivo" value="<?=$nombre_archivo?>">
                    <input type="hidden" name="url_actual" value="<?=$url_actual?>">
                </form>
                <div class="ui basic segment">
                    <form class="ui form" method="post" enctype="multipart/form-data" action="<?=site_url('archivo/subir_recurso')?>" id="frm_subir">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Archivo</label>
                                <input type="text" value="<?=$recurso['archivo']?>">
                            </div>
                            <div class="field disabled" id="btn_eliminar_archivo">
                                <label></label>
                                <a href="#" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" ><span class="ui red text"><i class="icon times circle outline"></span></i></a>
                            </div>
                            <div class="field">
                                <label>Subir archivo</label>
                                <?php
                                    $nombre_archivo = $recurso['archivo'];
                                    $up_dir = 'recs/';
                                    $url_actual = site_url('recurso/detalle/') . $recurso['id_recurso'] ;
                                    $nombre_archivo_fs = $up_dir . $nombre_archivo;
                                    $nombre_archivo_url = base_url($up_dir . $nombre_archivo);
                                ?>
                                    <div class="ui file input">
                                        <input type="file" name="userfile">
                                    </div>
                                    <input type="hidden" name="up_dir" value="<?=$up_dir?>">
                                    <input type="hidden" name="id_recurso" value="<?=$recurso['id_recurso']?>">
                                    <input type="hidden" name="archivo_actual" value="<?=$nombre_archivo?>">
                                    <input type="hidden" name="url_actual" value="<?=$url_actual?>">
                            </div>
                            <div class="field">
                                <label></label>
                                <button class="ui green disabled button" id="btn_subir">Subir</button>
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
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('recurso') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function() {
        if ( '<?= $recurso['archivo'] ?>' ) {
            $('#url').attr('readonly', true);
            $('#btn_eliminar_archivo').removeClass('disabled');
        }
    });

    $('#frm_subir').change( function () {
        $('#btn_subir').removeClass('disabled'); 
    });

    $('.ui.form')
        .form({
            fields: {
                nom_recurso: {
                    rules: [
                        {
                            type   : 'notEmpty',
                            prompt : 'Nombre no puede estar vacio'
                        }
                    ]
                },
                url: {
                    rules: [
                        {
                            type   : 'notEmpty',
                            prompt : 'url no puede estar vacio'
                        }
                    ]
                },
            }
        })
    ;

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
</script>

