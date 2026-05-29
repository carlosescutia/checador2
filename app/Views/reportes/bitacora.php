<div class="ui container">
    <div class="row">
        <div class="ui container">
            <div class="row">
                <h1 class="ui header">Bitácora de actividad</h1>
            </div>
            <div class="row no-print">
                <div class="ui right aligned basic segment">
                    <a class="ui mini button" href="<?= site_url('reportes/bitacora/csv') ?>">Exportar</a>
                    <a class="ui mini button" href="javascript:window.print()">Imprimir</a>
                </div>
            </div>

            <div class="row">
                <div class="sixteen wide column">
                    <table id="tbl_bitacora" class="ui very basic striped unstackable table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th data-priority="1">Fecha</th>
                                <th data-priority="2">Hora</th>
                                <th>Origen</th>
                                <th data-priority="1">nom_login</th>
                                <th>nom_usuario</th>
                                <th data-priority="1">accion</th>
                                <th data-priority="1">entidad</th>
                                <th data-priority="1">valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bitacora as $bitacora_item): ?>
                            <tr>
                                <td><?= $bitacora_item['id_evento'] ?></td>
                                <td><?= $bitacora_item['fecha'] ?></td>
                                <td><?= $bitacora_item['hora'] ?></td>
                                <td><?= $bitacora_item['origen'] ?></td>
                                <td><?= $bitacora_item['nom_login'] ?></td>
                                <td><?= $bitacora_item['nom_usuario'] ?></td>
                                <td><?= $bitacora_item['accion'] ?></td>
                                <td><?= $bitacora_item['entidad'] ?></td>
                                <td><?= $bitacora_item['valor'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tbl_bitacora').DataTable( {
        responsive: true,
        language: {
            url: '<?=base_url()?>assets/js/es-MX.json',
        },
    });
});
</script>
