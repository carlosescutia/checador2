<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar justificante
                        <button class="ui right floated primary button" type="submit" form="frm_justificante">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/justificante/guardar" id="frm_justificante">
                        <div class="four wide field">
                            <label>Fecha inicial</label>
                            <input type="date" name="fecha" id="fecha" value="<?= $justificante['fecha'] ?>">
                        </div>
                        <div class="four wide field">
                            <label>Fecha final</label>
                            <input type="date" name="fech_fin" id="fech_fin" value="<?= $justificante['fech_fin'] ?>">
                        </div>
                        <div class="four wide field">
                            <label>Tipo</label>
                            <div class="ui selection dropdown">
                                <input type="hidden" name="tipo_cobertura" value="<?= $justificante['tipo_cobertura'] ?>">
                                <i class="dropdown icon"></i>
                                <div class="default text">tipo</div>
                                <div class="menu">
                                    <?php foreach ($tipos_cobertura as $tipos_cobertura_item) { ?>
                                        <div class="item" data-value="<?=$tipos_cobertura_item['cve_tipo_cobertura'] ?>"><?=$tipos_cobertura_item['nom_tipo_cobertura'] ?></div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide field">
                            <label>Eventualidad</label>
                            <div class="ui selection search dropdown">
                                <input type="hidden" name="id_eventualidad" value="<?= $justificante['id_eventualidad'] ?>">
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
                            <textarea name="detalle" id="detalle" rows="4"><?= $justificante['detalle'] ?></textarea>
                        </div>
                        <input type="hidden" name="id_justificante" value="<?= $justificante['id_justificante'] ?>">
                        <input type="hidden" name="id_empleado" value="<?= $justificante['id_empleado'] ?>">
                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes/empleado/'.$justificante['id_empleado']) ?>">Volver</a>
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







