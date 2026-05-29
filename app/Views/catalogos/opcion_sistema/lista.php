<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Opciones sistema
                        <a class="ui right floated primary button" href="<?= site_url('opcion_sistema/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table" id="tbl_opciones_sistema">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Otorgable</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($opciones_sistema as $opciones_sistema_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('opcion_sistema/detalle/')?><?=$opciones_sistema_item['id_opcion_sistema']?>"><?= $opciones_sistema_item['nom_opcion_sistema'] ?></a>
                                        <div class="sub header"><?=$opciones_sistema_item['cod_opcion_sistema']?></div>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/opcion_sistema/guardar_otorgable" name="frm_usr<?=$opciones_sistema_item['id_opcion_sistema']?>">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="otorgable" id="otorgable" value="1" <?= ($opciones_sistema_item['otorgable'] == '1') ? 'checked' : '' ?> onchange="frm_usr<?=$opciones_sistema_item['id_opcion_sistema']?>.submit()">
                                        <label></label>
                                    </div>
                                    <input type="hidden" name="id_opcion_sistema" id="id_opcion_sistema" value="<?=$opciones_sistema_item['id_opcion_sistema']?>">
                                    <input type="hidden" name="cod_opcion_sistema" id="cod_opcion_sistema" value="<?=$opciones_sistema_item['cod_opcion_sistema']?>">
                                </form>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/opcion_sistema/eliminar" id="frm_elim_opcion_sistema<?=$opciones_sistema_item['id_opcion_sistema']?>">
                                    <input type="hidden" name="id_opcion_sistema" id="id_opcion_sistema" value="<?= $opciones_sistema_item['id_opcion_sistema'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('opcion_sistema') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará la opcion_sistema <strong>' . $opciones_sistema_item['nom_opcion_sistema'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_opcion_sistema' . $opciones_sistema_item['id_opcion_sistema'] ;
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
<script type="text/javascript">
$(document).ready( function () {
    $('#tbl_opciones_sistema').DataTable( {
        responsive: true,
        language: {
            url: '<?=base_url()?>assets/js/es-MX.json',
            lengthLabels: { 
                '-1': 'Todos'
            },
        },
        lengthMenu: [10, 50, -1],
    });
});
</script>
