<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nuevo justificante
                        <button class="ui right floated primary button" type="submit" form="frm_justificante">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/justificante/guardar" id="frm_justificante">
                        <div class="four wide field">
                            <label>Fecha inicial</label>
                            <input type="date" name="fecha" id="fecha" value="<?= $fecha ?>" <?= empty($fecha) ? '' : 'readonly' ?> >
                        </div>
                        <div class="four wide field">
                            <label>Fecha final</label>
                            <input type="date" name="fech_fin" id="fech_fin">
                        </div>
                        <div class="four wide field">
                            <label>Tipo</label>
                            <div class="ui selection dropdown">
                                <input type="hidden" name="tipo_cobertura">
                                <i class="dropdown icon"></i>
                                <div class="default text">tipo</div>
                                <div class="menu">
                                    <div class="item" data-value="dia">Dia</div>
                                    <div class="item" data-value="entrada">Entrada</div>
                                    <div class="item" data-value="salida">Salida</div>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide field">
                            <label>Eventualidad</label>
                            <div class="ui selection search dropdown">
                                <input type="hidden" name="id_eventualidad">
                                <i class="dropdown icon"></i>
                                <div class="default text">eventualidad</div>
                                <div class="menu">
                                    <?php foreach ($eventualidades as $eventualidades_item) { ?>
                                        <div class="item" data-value="<?=$eventualidades_item['id_eventualidad'] ?>"><?=$eventualidades_item['nom_eventualidad'] ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="ten wide field">
                            <label>Detalle</label>
                            <textarea name="detalle" id="detalle" rows="4"></textarea>
                        </div>
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
        }
    })
;
</script>








