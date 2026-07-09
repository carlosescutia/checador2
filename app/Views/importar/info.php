<div class="ui green segment">
    <h3 class="ui centered header">Asistencias</h3>

    <div class="ui divider"></div>

    <h4 class="ui header">Registros</h4>
    <?php
        $fmt = datefmt_create(
            'es_MX',
            IntlDateFormatter::NONE,
            IntlDateFormatter::NONE,
            null,
            IntlDateFormatter::GREGORIAN,
            'dd/MMM/yy HH:mm'
        );
        $asist_ant = strtotime($asistencia_antigua);
        $asist_rec = strtotime($asistencia_reciente);
    ?>
    <table class="ui unstackable small striped table"
        <tbody>
            <tr>
                <td>Totales</td>
                <td><?= number_format($tot_asistencias, 0) ?></td>
            </tr>
            <tr>
                <td>Más antiguo</td>
                <td><?= datefmt_format($fmt, $asist_ant) ?></td>
            </tr>
            <tr>
                <td>Más reciente</td>
                <td><?= datefmt_format($fmt, $asist_rec) ?></td>
            </tr>
        </tbody>
    </table>

    <div class="ui hidden divider"></div>
    <div class="ui hidden divider"></div>

    <h4 class="ui header">Configuración</h4>
    <table class="ui unstackable small striped table"
        <tbody>
            <tr>
                <td>Días a cargar</td>
                <td><?= $dias_cargar ?></td>
            </tr>
            <tr>
                <td>Tolerancia de retardo</td>
                <td><?= $tolerancia_retardo ?></td>
            </tr>
            <tr>
                <td>Tolerancia de asistencia</td>
                <td><?= $tolerancia_asistencia ?></td>
            </tr>
        </tbody>
    </table>
</div>
