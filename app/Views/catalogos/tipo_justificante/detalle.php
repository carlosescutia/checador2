<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar tipo de justificante
                        <button class="ui right floated primary button" type="submit" form="frm_tipo_justificante">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/tipo_justificante/guardar" id="frm_tipo_justificante">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Clave</label>
                                <input type="text" name="cve_tipo_justificante" id="cve_tipo_justificante" value="<?=$tipo_justificante['cve_tipo_justificante']?>" readonly>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_tipo_justificante" id="nom_tipo_justificante" value="<?=$tipo_justificante['nom_tipo_justificante']?>">
                            </div>
                        </div>
                        <input type="hidden" name="id_tipo_justificante" id="id_tipo_justificante" value="<?=$tipo_justificante['id_tipo_justificante']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('tipo_justificante') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_tipo_justificante: {
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

