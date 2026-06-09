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

                <div class="row">
                    <table class="ui very basic striped unstackable table">
                        <thead>
                            <tr>
                                <th class="four wide">Fecha</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Incidente</th>
                                <th class="five wide">Justificante</th>
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
                                    <?php if ( ! in_array($incidentes_empleado_item['cve_tipo_incidente'], array('sin_entrada_salida_temprano', 'sin_entrada')) ): ?>
                                        <?php if ( in_array($incidentes_empleado_item['cve_tipo_incidente'], array('retardo_salida_temprano','retardo','entrada_tardia_salida_temprano','entrada_tardia','entrada_tardia_sin_salida')) ): ?> <u> <?php endif ?>
                                        <?= is_null($incidentes_empleado_item['hora_entrada']) ? '' : date('H:i', strtotime($incidentes_empleado_item['hora_entrada'])) ?>
                                        <?php if ( in_array($incidentes_empleado_item['cve_tipo_incidente'], array('retardo_salida_temprano','retardo','entrada_tardia_salida_temprano','entrada_tardia','entrada_tardia_sin_salida')) ): ?> </u> <?php endif ?>
                                    <?php endif ?>
                                </td>
                                <td class="col-1">
                                    <?php if ( ! in_array($incidentes_empleado_item['cve_tipo_incidente'], array('retardo_sin_salida', 'entrada_tardia_sin_salida', 'sin_salida')) ): ?>
                                        <?php if ( in_array($incidentes_empleado_item['cve_tipo_incidente'], array('retardo_salida_temprano','entrada_tardia_salida_temprano','salida_temprano','sin_entrada_salida_temprano')) ): ?> <u> <?php endif ?>
                                        <?= is_null($incidentes_empleado_item['hora_salida']) ? '' : date('H:i', strtotime($incidentes_empleado_item['hora_salida'])) ?>
                                        <?php if ( in_array($incidentes_empleado_item['cve_tipo_incidente'], array('retardo_salida_temprano','entrada_tardia_salida_temprano','salida_temprano','sin_entrada_salida_temprano')) ): ?> </u> <?php endif ?>
                                    <?php endif ?>
                                </td>
                                <td class="col-2">
                                    <?php if ( ! $incidentes_empleado_item['id_justificante'] ): ?>
                                        <?php /* if (in_array('99', $accesos_sistema_rol)): */?>
                                            <!-- 
                                            <a href="<?=base_url()?>justificantes/nuevo_justificante/<?=$incidentes_empleado_item['id_empleado']?>/<?=$incidentes_empleado_item['fecha']?>"><?= $incidentes_empleado_item['nom_tipo_incidente'] ?></a>
                                            -->
                                        <?php /* else: */ ?>
                                            <?= $incidentes_empleado_item['nom_tipo_incidente'] ?>
                                        <?php /* endif */ ?>
                                    <?php endif ?>
                                </td>
                                <?php 
                                    $url = '';
                                    $texto = '' ;
                                    switch ($incidentes_empleado_item['tipo_justificante']): 
                                        case "di": 
                                            $url = base_url() . "dias_inhabiles/detalle/" . $incidentes_empleado_item['id_justificante'] ;
                                            $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                            break;
                                        case "jm": 
                                            $url = base_url() . "justificantes_masivos/detalle/" . $incidentes_empleado_item['id_justificante'] ;
                                            $texto = $incidentes_empleado_item['desc_corta_justificante'] . ': '. $incidentes_empleado_item['detalle'];
                                            break;
                                        case "ji": 
                                            $url = base_url() . "justificantes/detalle_justificante/" . $incidentes_empleado_item['id_justificante'] ;
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
            </div>
        </div>

        <div class="row no-print">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes') ?>">Volver</a>
            </div>
        </div>

    </div>
</div>


