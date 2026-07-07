<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar tipo de cobertura
                        <button class="ui right floated primary button" type="submit" form="frm_tipo_cobertura">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/tipo_cobertura/guardar" id="frm_tipo_cobertura">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Clave</label>
                                <input type="text" name="cve_tipo_cobertura" id="cve_tipo_cobertura" value="<?=$tipo_cobertura['cve_tipo_cobertura']?>" readonly>
                            </div>
                        </div>
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_tipo_cobertura" id="nom_tipo_cobertura" value="<?=$tipo_cobertura['nom_tipo_cobertura']?>">
                            </div>
                        </div>
                        <input type="hidden" name="id_tipo_cobertura" id="id_tipo_cobertura" value="<?=$tipo_cobertura['id_tipo_cobertura']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('tipo_cobertura') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_tipo_cobertura: {
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

