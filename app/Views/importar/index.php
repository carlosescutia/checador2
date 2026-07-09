<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="sixteen wide column">
                <div class="row">
                    <h1 class="ui header">
                        Importar
                    </h1>
                </div>

                <div class="ui hidden section divider"></div>

                <div class="row">
                    <div class="ui stackable grid">
                        <div class="row">
                            <div class="ten wide column">
                                <?php include "importar.php" ?>
                            </div>
                            <div class="six wide column">
                                <?php include "info.php" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url() ?>">Volver</a>
            </div>
        </div>
    </div>
</div>
