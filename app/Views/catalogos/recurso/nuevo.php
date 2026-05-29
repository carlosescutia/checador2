<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Agregar recurso
                        <button class="ui right floated primary button" type="submit" form="frm_recurso">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/recurso/guardar" id="frm_recurso">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_recurso" id="nom_recurso">
                            </div>
                            <div class="four wide field">
                                <label>Url</label>
                                <input type="text" name="url" id="url">
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
                <a class="ui basic button" href="<?= site_url('recurso') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
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
                        prompt : 'Url no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>

