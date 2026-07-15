<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nuevo empleado
                        <button class="ui right floated primary button" type="submit" form="frm_empleado">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/empleado/guardar" id="frm_empleado">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_empleado" id="nom_empleado">
                            </div>
                            <div class="two wide field">
                                <label>Clave checador</label>
                                <input type="text" name="cod_empleado" id="cod_empleado">
                            </div>
                            <div class="two wide field">
                                <label>Activo</label>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="activo" id="activo">
                                    <label></label>
                                </div>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Correo / login</label>
                                <input type="text" name="correo" id="correo">
                            </div>
                        </div>

                        <div class="ui error message"></div>
                    </form>
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
