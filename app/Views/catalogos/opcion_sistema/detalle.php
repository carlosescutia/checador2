<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar opción del sistema
                        <button class="ui right floated primary button" type="submit" form="frm_opcion_sistema">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/opcion_sistema/guardar" id="frm_opcion_sistema">
                        <div class="fields">
                            <div class="four wide field">
                                <label>Codigo</label>
                                <input type="text" name="cod_opcion_sistema" id="cod_opcion_sistema" value="<?=$opcion_sistema['cod_opcion_sistema']?>">
                            </div>
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_opcion_sistema" id="nom_opcion_sistema" value="<?=$opcion_sistema['nom_opcion_sistema']?>">
                            </div>
                            <div class="four wide field">
                                <label>Otorgable</label>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="otorgable" id="otorgable" value="1" <?= ($opcion_sistema['otorgable'] == '1') ? 'checked' : '' ?> >
                                    <label></label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_opcion_sistema" id="id_opcion_sistema" value="<?=$opcion_sistema['id_opcion_sistema']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('opcion_sistema') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_opcion_sistema: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Nombre no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>
