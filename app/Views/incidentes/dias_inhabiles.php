<div class="ui orange segment">
    <h4 class="ui center aligned header">
        <a class="circular ui right floated primary mini icon button" href="<?= site_url('dia_inhabil/nuevo') ?>">
            <i class="icon add"></i>
        </a>
        Dias inhábiles
    </h4>
    <div class="ui divider"></div>
    <div class="ui list">
        <table class="ui very basic tiny unstackable table">
            <thead>
                <tr>
                    <th class="four wide">fecha</th>
                    <th>detalle</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $dias_inhabiles as $dias_inhabiles_item): ?>
                <tr>
                    <td>
                        <?php
                            $fmt = datefmt_create(
                                'es_MX',
                                IntlDateFormatter::NONE,
                                IntlDateFormatter::NONE,
                                null,
                                IntlDateFormatter::GREGORIAN,
                                'dd/MMM/yy'
                            );
                            $fecha = strtotime($dias_inhabiles_item['fecha']);
                        ?>
                        <a href="<?= site_url('dia_inhabil/detalle/' . $dias_inhabiles_item['id_dia_inhabil']) ?>">
                            <?= datefmt_format($fmt, $fecha) ?>
                        </a>
                    </td>
                    <td><?= $dias_inhabiles_item['detalle'] ?></td>
                    <td>
                        <form class="ui form" method="post" action="/dia_inhabil/eliminar" id="frm_elim_dia_inhabil<?=$dias_inhabiles_item['id_dia_inhabil']?>">
                            <input type="hidden" name="id_dia_inhabil" id="id_dia_inhabil" value="<?= $dias_inhabiles_item['id_dia_inhabil'] ?>" >
                            <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('incidentes') ?>">
                            <?php
                                $mensaje = 'Se eliminará el dia inhábil <strong>' . datefmt_format($fmt, $fecha) . '</strong>.<br>¿Está seguro?' ;
                                $forma = '#frm_elim_dia_inhabil' . $dias_inhabiles_item['id_dia_inhabil'] ;
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
