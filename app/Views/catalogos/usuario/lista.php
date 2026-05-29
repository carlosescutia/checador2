<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Usuarios
                        <a class="ui right floated primary button" href="<?= site_url('usuario/nuevo') ?>">Agregar</a>
                    </h1>
                </div>

                <table class="ui very basic striped unstackable table">
                    <thead>
                        <tr>
                            <th>Nombre / rol</th>
                            <th>Login</th>
                            <th>Activo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuarios_item): ?>
                        <tr>
                            <td>
                                <h4 class="ui image header">
                                    <div class="content">
                                        <a href="<?=site_url('usuario/detalle/')?><?=$usuarios_item['id_usuario']?>"><?= $usuarios_item['nom_usuario'] ?></a>
                                        <div class="sub header"><?=$usuarios_item['id_rol']?></div>
                                    </div>
                                </h4>
                            </td>
                            <td> <?=$usuarios_item['nom_login']?> </td>
                            <td>
                                <form class="ui form" method="post" action="/usuario/guardar_activo" name="frm_usr<?=$usuarios_item['id_usuario']?>">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="activo" id="activo" value="1" <?= ($usuarios_item['activo'] == '1') ? 'checked' : '' ?> onchange="frm_usr<?=$usuarios_item['id_usuario']?>.submit()">
                                        <label></label>
                                    </div>
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?=$usuarios_item['id_usuario']?>">
                                    <input type="hidden" name="nom_login" id="nom_login" value="<?=$usuarios_item['nom_login']?>">
                                </form>
                            </td>
                            <td>
                                <form class="ui form" method="post" action="/usuario/eliminar" id="frm_elim_usuario<?=$usuarios_item['id_usuario']?>">
                                    <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuarios_item['id_usuario'] ?>" >
                                    <input type="hidden" name="url_actual" id="url_actual" value="<?= site_url('usuario') ?>">
                                    <?php
                                        $mensaje = 'Se eliminará el usuario <strong>' . $usuarios_item['nom_usuario'] . '</strong>.<br>¿Está seguro?' ;
                                        $forma = '#frm_elim_usuario' . $usuarios_item['id_usuario'] ;
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

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('catalogos') ?>">Volver</a>
            </div>
        </div>

    </div>
</div>
