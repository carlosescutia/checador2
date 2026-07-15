<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar empleado
                        <button class="ui right floated primary button" type="submit" form="frm_empleado">Guardar</button>
                    </h1>
                </div>
                <form class="ui form" method="post" action="/usuario/generar_token_cambio_pwd" id="frm_nuevo_token">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">
                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('empleado/detalle/' . $empleado['id_empleado']) ?>">
                </form>
                <form class="ui form" method="post" action="/usuario/eliminar_token_cambio_pwd" id="frm_eliminar_token">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">
                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('empleado/detalle/' . $empleado['id_empleado']) ?>">
                </form>


                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/empleado/guardar" id="frm_empleado">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_empleado" id="nom_empleado" value="<?=$empleado['nom_empleado']?>">
                            </div>
                            <div class="two wide field">
                                <label>Clave checador</label>
                                <input type="text" name="cod_empleado" id="cod_empleado" value="<?=$empleado['cod_empleado']?>">
                            </div>
                            <div class="two wide field">
                                <label>Activo</label>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="activo" id="activo" value="1" <?= ($empleado['activo'] == '1') ? 'checked' : '' ?> >
                                    <label></label>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Correo / login</label>
                                <input type="text" name="correo" id="correo" value="<?=$empleado['correo']?>">
                            </div>
                            <?php if ($usuario['token_cambio_pwd']): ?>
                                <div class="field">
                                    <label>Link para cambiar contraseña</label>
                                    <div class="ui action input">
                                        <input type="text" name="url_registro" id="url_registro" value="<?=site_url('usuario/nuevo_pwd/' . $usuario['token_cambio_pwd'])?>" >
                                        <div class="ui icon buttons">
                                            <a class="ui icon button" id="btn_clipboard" title="Copiar al portapapeles"> <i class="clipboard outline icon"></i> </a> 
                                            <a class="ui icon button" id="btn_qr" title="Mostrar código QR"><i class="qrcode icon"></i></a>
                                        </div>
                                        <?php
                                            $mensaje = 'Se eliminará el link para cambiar contraseña' ;
                                            $forma = '#frm_eliminar_token';
                                        ?>
                                    </div>
                                </div>
                                <div class="field">
                                    <label></label>
                                    <p></p>
                                    <a href="#" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" ><span class="ui red text"><i class="icon times circle outline"></span></i></a>
                                </div>
                            <?php else: ?>
                                <div class="field">
                                    <label>Contraseña</label>
                                    <a class="ui button" onclick="frm_nuevo_token.submit()">Cambiar</a>
                                </div>
                            <?php endif ?>
                        </div>
                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?=$empleado['id_empleado']?>">
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>

                <div class="ui horizontal divider">
                    Horarios especiales
                </div>

                <div class="row">
                    <div class="ui stackable grid">
                        <div class="row">
                            <div class="sixteen wide column">
                                <a class="ui right floated primary small button" href="<?= site_url('horario/nuevo/'.$empleado['id_empleado']) ?>">Agregar</a>
                            </div>
                            <?php if ( $horarios_activos ): ?>
                                <div class="eight wide column">
                                    <?php include 'horarios_activos.php' ?>
                                </div>
                            <?php endif ?>
                            <?php if ( $horarios_inactivos ): ?>
                                <div class="eight wide column">
                                    <?php include 'horarios_inactivos.php' ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('empleado') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<div class="ui mini modal">
    <i class="close icon"></i>
    <div class="image content">
        <div class="ui large image">
            <img class="ui bordered medium image" src="data:image/png;base64, <?= base64_encode($qr) ?>">
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_empleado: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Nombre no puede estar vacio'
                    }
                ]
            },
            cod_empleado: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Login no puede estar vacio'
                    }
                ]
            },
        }
    });

    $('#btn_clipboard').click( function() {
        $('#url_registro').select();
        document.execCommand('copy');
        $('#url_registro').blur();

        $.toast({
            message: 'Se copió el enlace para cambiar contraseña.',
            class: 'inverted teal',
        });
    });

    $('#btn_qr').click( function() {
        $('.ui.modal').modal('show');
    });
</script>
