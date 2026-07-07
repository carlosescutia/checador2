<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Eventualidades
                        <a class="ui right floated primary button" href="<?= site_url('eventualidad/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventualidades as $eventualidades_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('eventualidad/detalle/')?><?=$eventualidades_item['id_eventualidad']?>"><?= $eventualidades_item['nom_eventualidad'] ?></a>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/eventualidad/eliminar" id="frm_elim_eventualidad<?=$eventualidades_item['id_eventualidad']?>">
                                    <input type="hidden" name="id_eventualidad" id="id_eventualidad" value="<?= $eventualidades_item['id_eventualidad'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('eventualidad') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará la eventualidad: <strong>' . $eventualidades_item['nom_eventualidad'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_eventualidad' . $eventualidades_item['id_eventualidad'] ;
                                    ?>
                                    <a href="#" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" ><span class="ui red text"><i class="icon times circle outline"></span></i></a>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('catalogos') ?>">Volver</a>
            </div>
        </div>

    </div>
</div>

