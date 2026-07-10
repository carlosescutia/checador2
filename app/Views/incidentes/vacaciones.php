<div class="ui violet segment">
    <h4 class="ui center aligned header">
        <?php
            $permisos_requeridos = array(
                'justificante.can_edit',
            );
        ?>
        <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
            <a class="circular ui right floated primary mini icon button no-print" href="<?= site_url('vacacion/nuevo/'.$empleado['id_empleado']) ?>">
                <i class="icon add"></i>
            </a>
        <?php endif ?>
        Vacaciones
    </h4>
    <div class="ui divider"></div>
    <div class="ui list">
        <table class="ui very basic tiny unstackable table">
            <thead>
                <tr>
                    <th>desde</th>
                    <th>hasta</th>
                    <th>detalle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $vacaciones_empleado as $vacaciones_empleado_item): ?>
                    <?php
                        $url = '#';
                        if ($vacaciones_empleado_item['tipo_justificante'] == 'ji'):
                            $url = base_url() . 'justificantes/detalle_vacacion/' . $vacaciones_empleado_item['id_justificante'] ;
                        endif;
                        if ($vacaciones_empleado_item['tipo_justificante'] == 'jm'):
                            $url = base_url() . 'justificantes_masivos/detalle/' . $vacaciones_empleado_item['id_justificante'] ;
                        endif;
                    ?>
                    <tr>
                        <td>
                            <?php
                                $fmt = datefmt_create(
                                    'es_MX',
                                    IntlDateFormatter::NONE,
                                    IntlDateFormatter::NONE,
                                    null,
                                    IntlDateFormatter::GREGORIAN,
                                    'dd/MM/yy'
                                );
                                $fecha = strtotime($vacaciones_empleado_item['fecha']);
                            ?>
                            <?php
                                $permisos_requeridos = array(
                                    'justificante.can_edit',
                                );
                            ?>
                            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                                <a href="<?= site_url('vacacion/detalle/' . $vacaciones_empleado_item['id_justificante']) ?>">
                            <?php endif ?>
                                <?= datefmt_format($fmt, $fecha) ?>
                            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                                </a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php
                                $fmt = datefmt_create(
                                    'es_MX',
                                    IntlDateFormatter::NONE,
                                    IntlDateFormatter::NONE,
                                    null,
                                    IntlDateFormatter::GREGORIAN,
                                    'dd/MM/yy'
                                );
                                $fech_fin = strtotime($vacaciones_empleado_item['fech_fin']);
                            ?>
                            <?= datefmt_format($fmt, $fech_fin) ?>
                        </td>
                        <td>
                            <?php
                                $detalle = $vacaciones_empleado_item['nom_periodo_vacacional'] . ' ' . $vacaciones_empleado_item['anio'] . ' ' . $vacaciones_empleado_item['detalle'];
                            ?>
                            <?= $detalle ?> (<?= $vacaciones_empleado_item['dias'] ?>d)
                        </td>
                        <td class="no-print">
                            <?php
                                $permisos_requeridos = array(
                                    'justificante.can_edit',
                                );
                            ?>
                            <?php if (has_permission_or($permisos_requeridos, $permisos_usuario)): ?>
                                <form class="ui form" method="post" action="/justificante/eliminar" id="frm_elim_justificante<?=$vacaciones_empleado_item['id_justificante']?>">
                                    <input type="hidden" name="id_justificante" id="id_justificante" value="<?= $vacaciones_empleado_item['id_justificante'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('incidentes/empleado/'.$empleado['id_empleado']) ?>">
                                    <?php
                                        $mensaje = 'Se eliminará la vacación <strong>' . datefmt_format($fmt, $fecha) . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_justificante' . $vacaciones_empleado_item['id_justificante'] ;
                                    ?>
                                    <a href="#" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" ><span class="ui red text"><i class="icon times circle outline"></span></i></a>
                                </form>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


