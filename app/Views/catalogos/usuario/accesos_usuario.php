<div class="ui secondary segment">
    <div class="row">
        <h4 class="ui header">Accesos del usuario</h4>
        <table class="ui very basic small unstackable table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($accesos_sistema_usuario as $accesos_sistema_usuario_item): ?>
                <tr>
                    <td>
                        <div class="ui bulleted list">
                            <div class="item">
                                <div class="content">
                                    <div class="header"><?= $accesos_sistema_usuario_item['nom_opcion_sistema'] ?></div>
                                    <div class="description"><?=$accesos_sistema_usuario_item['cod_opcion_sistema']?></div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form class="ui form" method="post" action="/acceso_sistema_usuario/eliminar" id="frm_elim_acu<?=$accesos_sistema_usuario_item['id_acceso_sistema_usuario']?>">
                            <input type="hidden" name="id_acceso_sistema_usuario" id="id_acceso_sistema_usuario" value="<?= $accesos_sistema_usuario_item['id_acceso_sistema_usuario'] ?>" >
                            <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('usuario/detalle/'.$usuario['id_usuario']) ?>">
                            <?php
                                $mensaje = 'Se eliminará el Acceso: <strong>' . $accesos_sistema_usuario_item['cod_opcion_sistema'] . '</strong>.<br>¿Está seguro?' ;
                                $forma = '#frm_elim_acu' . $accesos_sistema_usuario_item['id_acceso_sistema_usuario'] ;
                            ?>
                            <a href="#" onclick="confirm_action('<?=$mensaje?>','<?=$forma?>')" ><span class="ui red text"><i class="icon times circle outline"></span></i></a>
                        </form>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="ui divider"></div>
    <div class="row">
        <form class="ui mini form" method="post" action="<?= site_url('acceso_sistema_usuario/guardar') ?>">
            <div class="fields">
                <div class="twelve wide field">
                    <div class="ui fluid search selection dropdown">
                        <input type="hidden" name="cod_opcion_sistema">
                        <i class="dropdown icon"></i>
                        <div class="default text">Acceso</div>
                        <div class="menu">
                            <?php foreach ($opciones_sistema_otorgables as $opciones_sistema_otorgables_item) { ?>
                            <div class="item" data-value="<?= $opciones_sistema_otorgables_item['cod_opcion_sistema'] ?>">
                                <div class="content">
                                    <div class="header"><?= $opciones_sistema_otorgables_item['nom_opcion_sistema'] ?></div>
                                    <div class="description"><?= $opciones_sistema_otorgables_item['cod_opcion_sistema'] ?></div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="four wide field">
                    <button class="ui green mini button" type="submit">Agregar</button>
                </div>
            </div>
            <input type="hidden" id="id_usuario" name="id_usuario" value="<?=$usuario['id_usuario']?>">
        </form>
    </div>
</div>
