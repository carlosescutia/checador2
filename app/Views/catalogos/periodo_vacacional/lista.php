<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Periodos vacacionales
                        <a class="ui right floated primary button" href="<?= site_url('periodo_vacacional/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Orden</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($periodos_vacacionales as $periodos_vacacionales_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('periodo_vacacional/detalle/')?><?=$periodos_vacacionales_item['id_periodo_vacacional']?>"><?= $periodos_vacacionales_item['nom_periodo_vacacional'] ?></a>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <?= $periodos_vacacionales_item['orden'] ?>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/periodo_vacacional/eliminar" id="frm_elim_periodo_vacacional<?=$periodos_vacacionales_item['id_periodo_vacacional']?>">
                                    <input type="hidden" name="id_periodo_vacacional" id="id_periodo_vacacional" value="<?= $periodos_vacacionales_item['id_periodo_vacacional'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('periodo_vacacional') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el Parámetro: <strong>' . $periodos_vacacionales_item['nom_periodo_vacacional'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_periodo_vacacional' . $periodos_vacacionales_item['id_periodo_vacacional'] ;
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
