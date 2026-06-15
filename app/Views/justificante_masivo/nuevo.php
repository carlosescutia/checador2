<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nuevo justificante masivo
                        <button class="ui right floated primary button" type="submit" form="frm_justificante_masivo">Guardar</button>
                    </h1>
                </div>
            </div>

            <div class="ui section divider"></div>

            <div class="sixteen wide column">
                <div class="row">
                    <div class="ui stackable grid">
                        <div class="eight wide column">
                            <div class="ui basic segment">
                                <form class="ui form" method="post" action="/justificante_masivo/guardar" id="frm_justificante_masivo">
                                    <div class="six wide field">
                                        <label>Fecha inicial</label>
                                        <input type="date" name="fecha" id="fecha">
                                    </div>
                                    <div class="six wide field">
                                        <label>Fecha final</label>
                                        <input type="date" name="fech_fin" id="fech_fin">
                                    </div>
                                    <div class="six wide field">
                                        <label>Tipo</label>
                                        <div class="ui selection dropdown">
                                            <input type="hidden" name="tipo_cobertura" id="tipo_cobertura">
                                            <i class="dropdown icon"></i>
                                            <div class="default text">tipo</div>
                                            <div class="menu">
                                                <?php foreach ($tipos_cobertura as $tipos_cobertura_item) { ?>
                                                <div class="item" data-value="<?=$tipos_cobertura_item['cve_tipo_cobertura'] ?>"><?=$tipos_cobertura_item['nom_tipo_cobertura'] ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="controles-periodo">
                                        <div class="six wide field">
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
                                    </div>

                                    <div class="ui hidden divider"></div>

                                    <div class="fourteen wide field">
                                        <label>Detalle</label>
                                        <textarea name="detalle" id="detalle" rows="4"></textarea>
                                    </div>
                                    <div class="ui error message"></div>
                                </form>
                            </div>
                        </div>
                        <div class="eight wide column">
                            <div class="ui clearing basic segment">
                                <h3 class="ui left floated header">
                                    Aplicar a:
                                </h3>
                                <h3 class="ui center floated header">
                                    <button class="ui tiny basic icon button" id="btn_todos"><i class="check square outline icon"></i>&nbsp;&nbsp;&nbsp;Todos</button>
                                    <button class="ui tiny basic icon button" id="btn_ninguno"><i class="square outline icon"></i>&nbsp;&nbsp;&nbsp;Ninguno</button>
                                </h3>
                            </div>
                            <div class="ui stackable grid">
                                <?php
                                    $tam = sizeof($empleados);
                                    $emp1 = array_slice($empleados, 0, $tam/2);
                                    $emp2 = array_slice($empleados, $tam/2, $tam);
                                ?>
                                <div class="eight wide column">
                                    <?php foreach ($emp1 as $emp1_item): ?>
                                        <div class="ui checkbox">
                                            <input type="checkbox" value="" name="chk<?=$emp1_item['id_empleado']?>" form="frm_justificante_masivo">
                                            <label><?= $emp1_item['nom_empleado'] ?></label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="eight wide column">
                                    <?php foreach ($emp2 as $emp2_item): ?>
                                        <div class="ui checkbox">
                                            <input type="checkbox" value="" name="chk<?=$emp2_item['id_empleado']?>" form="frm_justificante_masivo">
                                            <label><?= $emp2_item['nom_empleado'] ?></label>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.ui.checkbox').checkbox() ;
    });

    function cambia_estado_periodos() {
        if ( ["vacaciones"].includes($("#tipo_cobertura").val()) ) {
            $(".controles-periodo").show();
        } else {
            $(".controles-periodo").hide();
        }
    }

    $(document).ready(function() {

        cambia_estado_periodos();

        $('#btn_todos').click(function() {
            $('input').prop('checked', true);
        });

        $('#btn_ninguno').click(function() {
            $('input').prop('checked', false);
        });

        $('#tipo_cobertura').change( function() {
            cambia_estado_periodos();
        });

    });

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


