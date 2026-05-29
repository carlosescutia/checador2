<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar usuario
                        <button class="ui right floated primary button" type="submit" form="frm_usuario">Guardar</button>
                    </h1>
                </div>
                <form class="ui form" method="post" action="/usuario/generar_token_cambio_pwd" id="frm_nuevo_token">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">
                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('usuario/detalle/' . $usuario['id_usuario']) ?>">
                </form>
                <form class="ui form" method="post" action="/usuario/eliminar_token_cambio_pwd" id="frm_eliminar_token">
                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">
                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('usuario/detalle/' . $usuario['id_usuario']) ?>">
                </form>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/usuario/guardar" id="frm_usuario">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_usuario" id="nom_usuario" value="<?=$usuario['nom_usuario']?>">
                            </div>
                            <div class="four wide field">
                                <label>Login</label>
                                <input type="text" name="nom_login" id="nom_login" value="<?=$usuario['nom_login']?>" readonly>
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
                        <div class="fields">
                            <div class="four wide field">
                                <label>Rol</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="id_rol" value="<?=$usuario['id_rol']?>">
                                    <i class="dropdown icon"></i>
                                    <div class="default text">Rol</div>
                                    <div class="menu">
                                        <?php foreach ($roles as $roles_item) { ?>
                                            <div class="item" data-value="<?=$roles_item['id_rol'] ?>"><?=$roles_item['nom_rol'] ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="four wide field">
                                <label>Activo</label>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="activo" id="activo" value="1" <?= ($usuario['activo'] == '1') ? 'checked' : '' ?> >
                                    <label></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuario['id_usuario']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>

                <div class="row">
                    <div class="ui stackable grid">
                        <div class="row">
                            <div class="eight wide column">
                                <?php include 'accesos_rol.php' ?>
                            </div>
                            <div class="eight wide column">
                                <?php include 'accesos_usuario.php' ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('usuario') ?>">Volver</a>
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
            nom_usuario: {
                identifier: 'nom_usuario',
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Nombre no puede estar vacio'
                    }
                ]
            },
            nom_login: {
                identifier: 'nom_login',
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Login no puede estar vacio'
                    }
                ]
            },
            password: {
                identifier: 'password',
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Contraseña no puede estar vacio'
                    }
                ]
            },
            id_rol: {
                identifier: 'id_rol',
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Debe seleccionar un Rol'
                    }
                ]
            },
        }
    })
;
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
