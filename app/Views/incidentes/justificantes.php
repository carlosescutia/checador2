<div class="ui violet segment">
    <h4 class="ui center aligned header">
        <a class="circular ui right floated primary mini icon button no-print" href="<?= site_url('justificante/nuevo/'.$empleado['id_empleado']) ?>">
            <i class="icon add"></i>
        </a>
        Justificantes
    </h4>
    <div class="ui divider"></div>
    <div class="ui list">
        <table class="ui very basic tiny unstackable table">
            <thead>
                <tr>
                    <th>desde</th>
                    <th>hasta</th>
                    <th>tipo</th>
                    <th>detalle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $justificantes_empleado as $justificantes_empleado_item): ?>
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
                                $fecha = strtotime($justificantes_empleado_item['fecha']);
                            ?>
                            <a href="<?= site_url('justificante/detalle/' . $justificantes_empleado_item['id_justificante']) ?>">
                                <?= datefmt_format($fmt, $fecha) ?>
                            </a>
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
                                $fech_fin = strtotime($justificantes_empleado_item['fech_fin']);
                            ?>
                            <?= datefmt_format($fmt, $fech_fin) ?>
                        </td>
                        <td>
                            <?= $justificantes_empleado_item['tipo_cobertura'] ?>
                        </td>
                        <td>
                            <?php 
                                $lbl_dias = '';
                                if ($justificantes_empleado_item['tipo_cobertura'] == 'dia') {
                                    $lbl_dias = '(' . $justificantes_empleado_item['dias'] . 'd)';
                                }
                            ?>
                            <?= $justificantes_empleado_item['nom_eventualidad'] ?> <?= $lbl_dias ?>
                        </td>
                        <td class="no-print">
                            <form class="ui form" method="post" action="/justificante/eliminar" id="frm_elim_justificante<?=$justificantes_empleado_item['id_justificante']?>">
                                <input type="hidden" name="id_justificante" id="id_justificante" value="<?= $justificantes_empleado_item['id_justificante'] ?>" >
                                <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('incidentes/empleado/'.$empleado['id_empleado']) ?>">
                                <?php
                                    $mensaje = 'Se eliminará el justificante <strong>' . datefmt_format($fmt, $fecha) . ' ' . $justificantes_empleado_item['nom_eventualidad'] . '</strong>.<br>¿Está seguro?' ;
                                    $forma = '#frm_elim_justificante' . $justificantes_empleado_item['id_justificante'] ;
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



