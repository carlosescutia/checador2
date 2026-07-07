<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar tipo de incidente
                        <button class="ui right floated primary button" type="submit" form="frm_tipo_incidente">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/tipo_incidente/guardar" id="frm_tipo_incidente">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Clave</label>
                                <input type="text" name="cve_tipo_incidente" id="cve_tipo_incidente" value="<?=$tipo_incidente['cve_tipo_incidente']?>" readonly>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_tipo_incidente" id="nom_tipo_incidente" value="<?=$tipo_incidente['nom_tipo_incidente']?>">
                            </div>
                        </div>
                        <input type="hidden" name="id_tipo_incidente" id="id_tipo_incidente" value="<?=$tipo_incidente['id_tipo_incidente']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('tipo_incidente') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_tipo_incidente: {
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

