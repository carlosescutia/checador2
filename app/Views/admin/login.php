<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="icon" href="<?=base_url('favicon.png')?>"/>

        <title>Checador2</title>

        <!-- semantic-ui -->
        <script src="<?=base_url('assets/js/jquery.min.js')?>"></script>
        <link href="<?=base_url('assets/css/semantic.min.css')?>" rel="stylesheet"/>
        <script src="<?=base_url('assets/js/semantic.min.js')?>"></script>

        <style type="text/css">
        body {
            background-color: #f5f5f5;
        }
        body > .grid {
            height: 60%;
        }
        </style>
    </head>
    <body>
        <div class="ui stackable middle aligned center aligned grid">
            <div class="row">
                <div class="six wide column">
                    <div class="ui basic segment">
                        <h1 class="ui header">Checador2</h1>
                        <div class="ui divider"></div>

                        <?php if ($error): ?>
                            <div class="ui negative message transition">
                                <div class="header">
                                    Error
                                </div>
                                <p><?= $error ?></p>
                            </div>
                        <?php endif ?>

                        <img class="ui centered medium image" src="/assets/img/logotipo.png">

                        <h2 class="ui header">Inicie sesión</h2>

                        <form class="ui large form" method="post" action="<?= site_url('post_login') ?>">
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="user icon"></i>
                                    <input type="text" name="nom_login" id="nom_login" placeholder="Usuario">
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui left icon input">
                                    <i class="lock icon"></i>
                                    <input type="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                            <button class="ui fluid large primary button" type="submit">Iniciar sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready( function() {
        $('#nom_login').focus();
    });

    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
</script>
