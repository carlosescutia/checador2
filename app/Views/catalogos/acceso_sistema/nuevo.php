<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Agregar acceso sistema
                        <button class="ui right floated primary button" type="submit" form="frm_acceso_sistema">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/acceso_sistema/guardar" id="frm_acceso_sistema">
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
                                <label>Opción</label>
                                <div class="ui fluid search selection dropdown">
                                    <input type="hidden" name="cod_opcion_sistema">
                                    <i class="dropdown icon"></i>
                                    <div class="default text"></div>
                                    <div class="menu">
                                        <?php foreach ($opciones_sistema as $opciones_sistema_item) { ?>
                                            <div class="item" data-value="<?=$opciones_sistema_item['cod_opcion_sistema'] ?>"><?=$opciones_sistema_item['cod_opcion_sistema'] ?></div>
                                        <?php } ?>
                                    </div>
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
                <a class="ui basic button" href="<?= site_url('acceso_sistema') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            id_rol: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Rol no puede estar vacio'
                    }
                ]
            },
            cod_opcion_sistema: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Opción no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>
