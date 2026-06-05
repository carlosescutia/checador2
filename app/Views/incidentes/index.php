<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <div class="ui grid">
                        <div class="twelve wide column">
                            <h1 class="ui header">
                                Incidentes de asistencia
                            </h1>
                        </div>
                        <div class="four wide right floated column">
                            <?php include "selector_mes.php" ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <table class="ui very basic striped unstackable table" id="tbl_incidentes">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Nombre</th>
                                <th>Horario</th>
                                <th>Incidentes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($incidentes_empleados as $incidentes_empleados_item): ?>
                            <tr>
                                <td> <?=$incidentes_empleados_item['cod_empleado']?> </td>
                                <td>
                                    <a href="<?=site_url('incidentes/empleado/')?><?=$incidentes_empleados_item['id_empleado']?>"><?= $incidentes_empleados_item['nom_empleado'] ?></a>
                                </td>
                                <td> <?=$incidentes_empleados_item['nom_horario']?> </td>
                                <td> <?=$incidentes_empleados_item['num_incidentes']?> </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidente') ?>">Volver</a>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
$(document).ready( function () {
    $('#tbl_incidentes').DataTable( {
        responsive: true,
        pageLength: 50,
        lengthMenu: [10, 50, -1],
        order: [ [1, 'asc'] ],
        language: {
            url: '<?=base_url()?>assets/js/es-MX.json',
            lengthLabels: { 
                '-1': 'Todos'
            },
        },
    });
});
</script>
