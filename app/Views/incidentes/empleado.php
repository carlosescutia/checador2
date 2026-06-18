<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <div class="ui grid">
                        <div class="twelve wide column">
                            <h3 class="ui header">
                                Incidentes de <?=$empleado['nom_empleado'] ?>
                            </h3>
                        </div>
                        <div class="four wide right floated column">
                            <?php include "selector_mes.php" ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sixteen wide column">
                <div class="row">
                    <div class="ui stackable grid">
                        <div class="ten wide column">
                            <table class="ui very basic striped unstackable table">
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
                                                <div class="content">Incidente</div>
                                                <div class="center aligned sub header"><?= $num_incidentes ?></div>
                                            </h5>
                                        </th>
                                        <th class="seven wide">Justificante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($incidentes_empleado as $incidentes_empleado_item): ?>
                                    <tr>
                                        <td class="col-2">
                                            <?php
                                                $fmt = datefmt_create(
                                                    'es_MX',
                                                    IntlDateFormatter::NONE,
                                                    IntlDateFormatter::NONE,
                                                    null,
                                                    IntlDateFormatter::GREGORIAN,
                                                    'EEE dd/MMM/yy'
                                                );
                                                $fecha = strtotime($incidentes_empleado_item['fecha']);
                                            ?>
                                            <?= datefmt_format($fmt, $fecha) ?>
                                        </td>
                                        <td class="col-1">
                                            <?php if ( $incidentes_empleado_item['cve_tipo_incidente'] !== 'sin_entrada' ): ?>
                                                <h5 class="ui header">
                                                    <?php if ( ! is_null($incidentes_empleado_item['hora_entrada']) ): ?>
                                                        <div class="content">
                                                            <?php if ( $incidentes_empleado_item['cve_tipo_cobertura'] == 'entrada' ): ?> 
                                                                <u> 
                                                            <?php endif ?>
                                                            <?=  date('H:i', strtotime($incidentes_empleado_item['hora_entrada'])) ?>
                                                            <?php if ( $incidentes_empleado_item['cve_tipo_cobertura'] == 'entrada' ): ?> 
                                                                </u> 
                                                            <?php endif ?>
                                                            <div class="sub header">
                                                                <?= date('H:i', strtotime($incidentes_empleado_item['horario_entrada'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </h5>
                                            <?php endif ?>
                                        </td>
                                        <td class="col-1">
                                            <?php if ( $incidentes_empleado_item['cve_tipo_incidente'] !== 'sin_salida' ): ?>
                                                <h5 class="ui header">
                                                    <?php if ( ! is_null($incidentes_empleado_item['hora_salida']) ): ?>
                                                        <div class="content">
                                                            <?php if ( $incidentes_empleado_item['cve_tipo_cobertura'] == 'salida' ): ?> 
                                                                <u>
                                                            <?php endif ?>
                                                            <?= date('H:i', strtotime($incidentes_empleado_item['hora_salida'])) ?>
                                                            <?php if ( $incidentes_empleado_item['cve_tipo_cobertura'] == 'salida' ): ?> 
                                                                </u>
                                                            <?php endif ?>
                                                            <div class="sub header">
                                                                <?= date('H:i', strtotime($incidentes_empleado_item['horario_salida'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif ?>
                                                </h5>
                                            <?php endif ?>
                                        </td>
                                        <td class="col-2">
                                            <?php if ( ! $incidentes_empleado_item['id_justificante'] ): ?>
                                            <a href="<?= site_url('justificante/nuevo/'.$incidentes_empleado_item['id_empleado'].'/'.$incidentes_empleado_item['fecha']) ?>"><?= $incidentes_empleado_item['nom_tipo_incidente'] ?></a>
                                            <?php endif ?>
                                        </td>
                                        <?php 
                                            $url = '';
                                            $texto = '' ;
                                            switch ($incidentes_empleado_item['tipo_justificante']): 
                                                case "di": 
                                                    $url = site_url() . "dia_inhabil/detalle/" . $incidentes_empleado_item['id_justificante'] ;
                                                    $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                                    break;
                                                case "jm": 
                                                    $url = site_url() . "justificante_masivo/detalle/" . $incidentes_empleado_item['id_justificante'] ;
                                                    $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                                    break;
                                                case "ji": 
                                                    $url = site_url() . "justificante/detalle/" . $incidentes_empleado_item['id_justificante'] ;
                                                    $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                                    break;
                                                case "hc": 
                                                    $url = '#';
                                                    $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                                    break;
                                            endswitch
                                        ?>
                                        <td class="col-6">
                                            <?php if ($incidentes_empleado_item['tipo_justificante'] == 'hc'): ?>
                                                <?=$texto?>
                                            <?php else:?>
                                                <a href="<?=$url?>"><?=$texto?></a>
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="six wide column">
                            <div class="ui hidden section divider"></div>
                            <div class="ui hidden section divider"></div>
                            <?php include 'vacaciones.php' ?>
                            <div class="ui hidden divider"></div>
                            <?php include 'justificantes.php' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-print">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes') ?>">Volver</a>
            </div>
        </div>

    </div>
</div>


