<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="fifteen wide column">
                <div class="row">
                    <h1 class="ui header">
                        Recursos
                        <a class="ui right floated primary button" href="<?= site_url('recurso/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table" id="tbl_recursos">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Url</th>
                            <th>Archivo</th>
                            <th>Activo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recursos as $recursos_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('recurso/detalle/')?><?=$recursos_item['id_recurso']?>"><?= $recursos_item['nom_recurso'] ?></a>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?= $recursos_item['url'] ?>" target="_blank"><?= $recursos_item['url'] ?></a>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <?= $recursos_item['archivo'] ?>
                                    </div>
                                </h4>
                            </td>
                            <td>
                                <div class="ui toggle checkbox">
                                    <input type="checkbox" name="activo" id="activo" value="1" <?= ($recursos_item['activo'] == '1') ? 'checked' : '' ?> disabled>
                                    <label></label>
                                </div>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/recurso/eliminar" id="frm_elim_recurso<?=$recursos_item['id_recurso']?>">
                                    <input type="hidden" name="id_recurso" id="id_recurso" value="<?= $recursos_item['id_recurso'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('recurso') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el Recurso: <strong>' . $recursos_item['nom_recurso'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_recurso' . $recursos_item['id_recurso'] ;
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
    $('#tbl_recursos').DataTable( {
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
