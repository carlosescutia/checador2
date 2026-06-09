<div class="ui violet segment">
    <h4 class="ui center aligned header">
        <a class="circular ui right floated primary mini icon button" href="<?= site_url('justificante_masivo/nuevo') ?>">
            <i class="icon add"></i>
        </a>
        Justificantes masivos
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
                <?php foreach ( $justificantes_masivos as $justificantes_masivos_item): ?>
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
                            $fecha = strtotime($justificantes_masivos_item['fecha']);
                        ?>
                        <a href="<?= site_url('justificante_masivo/detalle/' . $justificantes_masivos_item['id_justificante_masivo']) ?>">
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
                            $fech_fin = strtotime($justificantes_masivos_item['fech_fin']);
                        ?>
                        <?= datefmt_format($fmt, $fech_fin) ?>
                    </td>
                    <td><?= $justificantes_masivos_item['tipo_cobertura'] ?></td>
                    <td><?= $justificantes_masivos_item['detalle'] ?></td>
                    <td>
                        <form class="ui form" method="post" action="/justificante_masivo/eliminar" id="frm_elim_justificante_masivo<?=$justificantes_masivos_item['id_justificante_masivo']?>">
                            <input type="hidden" name="id_justificante_masivo" id="id_justificante_masivo" value="<?= $justificantes_masivos_item['id_justificante_masivo'] ?>" >
                            <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('incidentes') ?>">
                            <?php
                                $mensaje = 'Se eliminará el justificante masivo <strong>' . datefmt_format($fmt, $fecha) . ' ' . $justificantes_masivos_item['tipo_cobertura'] . '</strong>.<br>¿Está seguro?' ;
                                $forma = '#frm_elim_justificante_masivo' . $justificantes_masivos_item['id_justificante_masivo'] ;
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

