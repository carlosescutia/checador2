<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Accesos sistema
                        <a class="ui right floated primary button" href="<?= site_url('acceso_sistema/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table id="tbl_accesos" class="ui very basic striped unstackable table">
                    <thead>
                        <tr>
                            <th>Rol</th>
                            <th>Acceso</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accesos_sistema as $accesos_sistema_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui header">
                                    <div class="content">
                                        <?= $accesos_sistema_item['nom_rol'] ?>
                                        <div class="sub header"><?=$accesos_sistema_item['id_rol']?></div>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <h4 class="ui header">
                                    <div class="content">
                                        <?= $accesos_sistema_item['nom_opcion_sistema'] ?>
                                        <div class="sub header"><?=$accesos_sistema_item['cod_opcion_sistema']?></div>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/acceso_sistema/eliminar" id="frm_elim_acceso_sistema<?=$accesos_sistema_item['id_acceso_sistema']?>">
                                    <input type="hidden" name="id_acceso_sistema" id="id_acceso_sistema" value="<?= $accesos_sistema_item['id_acceso_sistema'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('acceso_sistema') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el Acceso: <strong>' . $accesos_sistema_item['id_rol'] . ' ' . $accesos_sistema_item['cod_opcion_sistema'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_acceso_sistema' . $accesos_sistema_item['id_acceso_sistema'] ;
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
    $('#tbl_accesos').DataTable( {
        language: {
            url: '<?=base_url()?>assets/js/es-MX.json',
        },
    });
});
</script>
