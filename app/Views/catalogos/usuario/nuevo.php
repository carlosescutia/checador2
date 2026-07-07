<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Agregar usuario
                        <button class="ui right floated primary button" type="submit" form="frm_usuario">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/usuario/guardar" id="frm_usuario">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_usuario" id="nom_usuario">
                            </div>
                            <div class="four wide field">
                                <label>Login</label>
                                <input type="text" name="nom_login" id="nom_login">
                            </div>
                            <div class="four wide field">
                                <label>Contraseña</label>
                                <input type="text" name="password" id="password">
                            </div>
                        </div>
                        <input type="hidden" id="nom_existente" value="inexistente">
                        <div class="fields">
                            <div class="four wide field">
                                <label>Rol</label>
                                <div class="ui selection dropdown">
                                    <input type="hidden" name="id_rol">
                                    <i class="dropdown icon"></i>
                                    <div class="default text"></div>
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
                                    <input type="checkbox" name="activo" id="activo" value="1">
                                    <label></label>
                                </div>
                            </div>
                        </div>

                        <div class="ui error message"></div>
                    </form>
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

<script>
    $('#nom_login').change ( function () {
        nom_login = $('#nom_login').val();
        test_url = "<?= site_url('usuario/existe/') ?>" + nom_login ;
        $.get(test_url, function(data, status) {
            if (data) {
                $('#nom_existente').val(nom_login);
            }
        });
    });

$('.ui.form')
    .form({
        fields: {
            nom_usuario: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Nombre no puede estar vacio'
                    }
                ]
            },
            nom_login: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Login no puede estar vacio'
                    },
                    {
                        type   : 'different[nom_existente]',
                        prompt : 'Ya existe el nombre de usuario, selecciona otro'
                    },
                ]
            },
            password: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Contraseña no puede estar vacio'
                    }
                ]
            },
            id_rol: {
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
</script>
