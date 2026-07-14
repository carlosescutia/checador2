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
                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?=$empleado['id_empleado']?>">

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
</script>
