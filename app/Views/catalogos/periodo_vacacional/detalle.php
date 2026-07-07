<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar periodo vacacional
                        <button class="ui right floated primary button" type="submit" form="frm_periodo_vacacional">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/periodo_vacacional/guardar" id="frm_periodo_vacacional">
                        <div class="fields">
                            <div class="eight wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_periodo_vacacional" id="nom_periodo_vacacional" value="<?=$periodo_vacacional['nom_periodo_vacacional']?>">
                            </div>
                            <div class="four wide field">
                                <label>Orden</label>
                                <input type="text" name="orden" id="orden" value="<?=$periodo_vacacional['orden']?>">
                            </div>
                        </div>
                        <input type="hidden" name="id_periodo_vacacional" id="id_periodo_vacacional" value="<?=$periodo_vacacional['id_periodo_vacacional']?>">

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('periodo_vacacional') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            nom_periodo_vacacional: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Nombre no puede estar vacio'
                    }
                ]
            },
            orden: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Orden no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>
