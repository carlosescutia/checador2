<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Parametros sistema
                        <a class="ui right floated primary button" href="<?= site_url('parametro_sistema/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parametros_sistema as $parametros_sistema_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('parametro_sistema/detalle/')?><?=$parametros_sistema_item['id_parametro_sistema']?>"><?= $parametros_sistema_item['nom_parametro_sistema'] ?></a>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <?= $parametros_sistema_item['valor'] ?>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/parametro_sistema/eliminar" id="frm_elim_parametro_sistema<?=$parametros_sistema_item['id_parametro_sistema']?>">
                                    <input type="hidden" name="id_parametro_sistema" id="id_parametro_sistema" value="<?= $parametros_sistema_item['id_parametro_sistema'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('parametro_sistema') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el Parámetro: <strong>' . $parametros_sistema_item['nom_parametro_sistema'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_parametro_sistema' . $parametros_sistema_item['id_parametro_sistema'] ;
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
