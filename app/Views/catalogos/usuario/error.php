<div class="ui container">
    <div class="ui stackable centered grid">
        <div class="seven wide column">
            <div class="row">
                <div class="ui green center aligned segment">
                    <h1 class="ui center aligned header">Registro de nuevo alumno</h1>
                    <?php if ($error): ?>
                        <div class="ui negative message transition">
                            <div class="header">
                                Error
                            </div>
                            <p><?= $error ?></p>
                        </div>
                    <?php endif ?>

                    <div class="ui hidden divider"></div>

                    <div class="ui basic center aligned segment">
                        <div class="ui medium image">
                            <img class="ui bordered image" src="<?= base_url('assets/img/image.png') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

