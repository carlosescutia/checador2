<h4 class="ui header">Horarios inactivos</h4>
<div class="ui styled accordion">
    <?php foreach ($horarios_inactivos as $horarios_inactivos_item): ?>
    <div class="title">
        <i class="dropdown icon"></i>
        <?php
            $fmt = datefmt_create(
                'es_MX',
                IntlDateFormatter::NONE,
                IntlDateFormatter::NONE,
                null,
                IntlDateFormatter::GREGORIAN,
                'dd/MMM/yy'
            );
            $fech_ini = strtotime($horarios_inactivos_item['fech_ini']);
            $fech_fin = strtotime($horarios_inactivos_item['fech_fin']);
        ?>
        <?= datefmt_format($fmt, $fech_ini) ?> a <?= datefmt_format($fmt, $fech_fin) ?>
    </div>
    <div class="content">
        <div class="ui grid">
            <div class="four wide column">
                <a class="ui mini green button" href="<?= site_url('horario/detalle/'.$horarios_inactivos_item['id_horario']) ?>">Editar</a>
            </div>
            <div class="four wide column">
                <form class="ui form" method="post" action="/horario/eliminar" id="frm_elim_horario<?=$horarios_inactivos_item['id_horario']?>">
                    <input type="hidden" name="id_horario" id="id_horario" value="<?= $horarios_inactivos_item['id_horario'] ?>" >
                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('empleado/detalle/'.$horarios_inactivos_item['id_empleado']) ?>">
                    <?php
                        $mensaje = 'Se eliminará el horario <strong>' . datefmt_format($fmt, $fech_ini) . ' a ' . datefmt_format($fmt, $fech_fin) . '</strong>.<br>¿Está seguro?' ;
                        $forma = '#frm_elim_horario' . $horarios_inactivos_item['id_horario'] ;
                    ?>
                    <a class="ui mini orange button" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" >Eliminar</a>
                </form>
            </div>
        </div>

        <table class="ui very basic collapsing unstackable small table"
            <tbody>
            <?php foreach($horarios_dias[$horarios_inactivos_item['id_horario']] as $horarios_dias_item): ?>
                <tr>
                    <td><?= $horarios_dias_item['nom_dia'] ?></td>
                    <td><?= date('h:i a', strtotime($horarios_dias_item['hora_entrada'])) ?></td>
                    <td><?= date('h:i a', strtotime($horarios_dias_item['hora_salida'])) ?></td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php endforeach ?>
</div>

<script>
    $(document).ready(function() {
        $('.ui.accordion')
            .accordion()
        ;
    });
</script>
