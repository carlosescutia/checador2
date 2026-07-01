<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Empleados
                        <a class="ui right floated primary button" href="<?= site_url('empleado/nuevo') ?>">Agregar</a>
                    </h1>
                    <form class="ui form" method="get" action="/empleado" name="frm_filtro">
                        <div class="inline fields">
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="estado" <?= $estado == 'activos' ? 'checked' : '' ?> tabindex="0" class="hidden estado" value="activos">
                                    <label>Activos</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="estado" <?= $estado == 'inactivos' ? 'checked' : '' ?> tabindex="0" class="hidden estado" value="inactivos">
                                    <label>Inactivos</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="estado" <?= $estado == 'todos' ? 'checked' : '' ?> tabindex="0" class="hidden estado" value="todos">
                                    <label>Todos</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <table class="ui very basic striped unstackable table" id="tbl_empleados">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Activo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleados_item): ?>
                        <tr>
                            <td>
                                <a href="<?=site_url('empleado/detalle/')?><?=$empleados_item['id_empleado']?>"><?= $empleados_item['nom_empleado'] ?></a>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/empleado/guardar_activo" name="frm_usr<?=$empleados_item['id_empleado']?>">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="activo" id="activo" value="1" <?= ($empleados_item['activo'] == '1') ? 'checked' : '' ?> onchange="frm_usr<?=$empleados_item['id_empleado']?>.submit()">
                                        <label></label>
                                    </div>
                                    <input type="hidden" name="id_empleado" id="id_empleado" value="<?=$empleados_item['id_empleado']?>">
                                </form>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/empleado/eliminar" id="frm_elim_empleado<?=$empleados_item['id_empleado']?>">
                                    <input type="hidden" name="id_empleado" id="id_empleado" value="<?= $empleados_item['id_empleado'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('empleado') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el empleado <strong>' . $empleados_item['nom_empleado'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_empleado' . $empleados_item['id_empleado'] ;
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

<script>
    $(document).ready( function() {

        $('.ui.radio.checkbox').checkbox();

        $('.estado').change( function() {
            this.form.submit();
        });

        $('#tbl_empleados').DataTable( {
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
