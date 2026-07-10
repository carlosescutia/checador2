<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Detalle del rol
                    </h1>
                </div>

                <div class="ui basic segment">
                    <div class="ui form">
                        <div class="fields">
                            <div class="four wide field">
                                <label>id_rol</label>
                                <input type="text" name="id_rol" id="id_rol" value="<?=$rol['id_rol']?>" readonly>
                            </div>
                            <div class="six wide field">
                                <label>Nombre</label>
                                <input type="text" name="nom_rol" id="nom_rol" value="<?=$rol['nom_rol']?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="ui stackable grid">
                        <div class="row">
                            <div class="eight wide column">
                                <div class="ui secondary segment">
                                    <h4 class="ui header">Accesos del rol</h4>
                                    <div class="ui bulleted list">
                                        <?php foreach ($accesos_sistema_rol as $accesos_sistema_rol_item): ?>
                                            <div class="item">
                                                <div class="content">
                                                    <div class="header"><?= $accesos_sistema_rol_item['nom_opcion_sistema'] ?></div>
                                                    <div class="description"><?=$accesos_sistema_rol_item['cod_opcion_sistema']?></div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('rol') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>
