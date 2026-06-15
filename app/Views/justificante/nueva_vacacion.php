<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nueva vacación
                        <button class="ui right floated primary button" type="submit" form="frm_justificante">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/vacacion/guardar" id="frm_justificante">
                        <div class="four wide field">
                            <label>Fecha inicial</label>
                            <input type="date" name="fecha" id="fecha">
                        </div>
                        <div class="four wide field">
                            <label>Fecha final</label>
                            <input type="date" name="fech_fin" id="fech_fin">
                        </div>
                        <div class="four wide field">
                            <label>Periodo</label>
                            <div class="ui selection dropdown">
                                <input type="hidden" name="id_periodo_vacacional">
                                <i class="dropdown icon"></i>
                                <div class="default text">periodo</div>
                                <div class="menu">
                                    <?php foreach ($periodos_vacacionales as $periodos_vacacionales_item) { ?>
                                        <div class="item" data-value="<?=$periodos_vacacionales_item['id_periodo_vacacional'] ?>"><?=$periodos_vacacionales_item['nom_periodo_vacacional'] ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="four wide field">
                            <label>Año</label>
                            <input type="number" name="anio" id="anio">
                        </div>
                        <div class="ten wide field">
                            <label>Detalle</label>
                            <textarea name="detalle" id="detalle" rows="4"></textarea>
                        </div>
                        <input type="hidden" name="tipo_cobertura" value="vacaciones">
                        <input type="hidden" name="id_empleado" value="<?= $id_empleado ?>">
                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes/empleado/'.$id_empleado) ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            fecha: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Fecha no puede estar vacio'
                    }
                ]
            },
            tipo_cobertura: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Tipo no puede estar vacio'
                    }
                ]
            },
            detalle: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Detalle no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>




