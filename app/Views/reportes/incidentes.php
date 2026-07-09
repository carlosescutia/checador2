<div class="ui container">
    <div class="row">
        <div class="eight wide column no-print">
            <div class="row">
                <div class="ui grid">
                    <div class="row">
                        <div class="five wide column">
                            <h1 class="ui header">Incidentes por fecha</h1>
                        </div>
                        <div class="seven wide column">
                            <?php include "selector_fecha.php" ?>
                        </div>
                        <div class="four wide column">
                            <div class="ui right aligned basic segment">
                                <a class="ui mini button" href="<?= site_url('reportes/incidentes/csv') ?>">Exportar</a>
                                <a class="ui mini button" href="javascript:window.print()">Imprimir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sixteen wide column">
            <div class="row">
                <div class="sixteen wide column">
                    <?php
                        $fmt = datefmt_create(
                            'es_MX',
                            IntlDateFormatter::NONE,
                            IntlDateFormatter::NONE,
                            null,
                            IntlDateFormatter::GREGORIAN,
                            'EEE dd/MMM/yy'
                        );
                        $fech_ini = strtotime($fech_ini);
                        $fech_fin = strtotime($fech_fin);
                    ?>
                    <?php foreach ($empleados as $empleados_item): ?>
                        <div class="ui grey inverted segment">
                            <h3 class="ui header">
                            <?= $empleados_item['nom_empleado'] ?> - Incidentes del <?= datefmt_format($fmt, $fech_ini) ?> al  <?= datefmt_format($fmt, $fech_fin) ?>
                            </h3>
                        </div>
                        <table id="tbl_asistencia" class="ui very basic striped unstackable table">
                            <thead>
                                <tr>
                                    <th class="four wide">Fecha</th>
                                    <th>
                                        <h5 class="ui header">
                                            <div class="content">Entrada</div>
                                            <div class="sub header">Horario</div>
                                        </h5>
                                    </th>
                                    <th>
                                        <h5 class="ui header">
                                            <div class="content">Salida</div>
                                            <div class="sub header">Horario</div>
                                        </h5>
                                    </th>
                                    <th>
                                        <h5 class="ui header">
                                            <?php
                                                $num_incidentes_empleado = $num_incidentes[$empleados_item['id_empleado']][0]['num_incidentes'];
                                            ?>
                                            <div class="content">Incidente</div>
                                            <div class="left aligned sub header"><?= $num_incidentes_empleado ?></div>
                                        </h5>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($incidentes_empleados[$empleados_item['id_empleado']] as $incidentes_empleados_item): ?>
                                    <tr>
                                        <td>
                                            <?php
                                                $fecha = strtotime($incidentes_empleados_item['fecha']);
                                            ?>
                                            <?= datefmt_format($fmt, $fecha) ?>
                                        </td>
                                        <td class="col-1">
                                            <?php if ( $incidentes_empleados_item['cve_tipo_incidente'] !== 'sin_entrada' ): ?>
                                                <h5 class="ui header">
                                                    <?php if ( ! is_null($incidentes_empleados_item['hora_entrada']) ): ?>
                                                        <div class="content">
                                                            <?php if ( $incidentes_empleados_item['cve_tipo_cobertura'] == 'entrada' ): ?> 
                                                                <u> 
                                                            <?php endif ?>
                                                            <?=  date('H:i', strtotime($incidentes_empleados_item['hora_entrada'])) ?>
                                                            <?php if ( $incidentes_empleados_item['cve_tipo_cobertura'] == 'entrada' ): ?> 
                                                                </u> 
                                                            <?php endif ?>
                                                            <div class="sub header">
                                                                <?= date('H:i', strtotime($incidentes_empleados_item['horario_entrada'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </h5>
                                            <?php endif ?>
                                        </td>
                                        <td class="col-1">
                                            <?php if ( $incidentes_empleados_item['cve_tipo_incidente'] !== 'sin_salida' ): ?>
                                                <h5 class="ui header">
                                                    <?php if ( ! is_null($incidentes_empleados_item['hora_salida']) ): ?>
                                                        <div class="content">
                                                            <?php if ( $incidentes_empleados_item['cve_tipo_cobertura'] == 'salida' ): ?> 
                                                                <u> 
                                                            <?php endif ?>
                                                            <?=  date('H:i', strtotime($incidentes_empleados_item['hora_salida'])) ?>
                                                            <?php if ( $incidentes_empleados_item['cve_tipo_cobertura'] == 'salida' ): ?> 
                                                                </u> 
                                                            <?php endif ?>
                                                            <div class="sub header">
                                                                <?= date('H:i', strtotime($incidentes_empleados_item['horario_salida'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </h5>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ( ! $incidentes_empleados_item['id_justificante'] ): ?>
                                                <?= $incidentes_empleados_item['nom_tipo_incidente'] ?>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="ui hidden divider page-break"></div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</div>

