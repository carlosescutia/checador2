<div class="ui container">
    <div class="ui stackable centered grid">
        <div class="seven wide column">
            <h1 class="ui center aligned header">Nueva contraseña</h1>
            <h3 class="ui center aligned header"><?= $usuario['nom_usuario'] ?></h3>
            <img class="ui centered tiny image" src="/assets/img/logotipo.png">

            <div class="ui green segment">
                <div class="ui centered grid">
                    <div class="row">
                        <div class="fourteen wide column">
                            <form class="ui form" method="post" action="/usuario/actualizar_password">
                                <div class="field">
                                    <label>Contraseña</label>
                                    <input type="text" name="password" id="password">
                                </div>
                                <div class="field">
                                    <label>Teclee de nuevo la contraseña</label>
                                    <input type="text" name="repetir_pwd" id="repetir_pwd">
                                </div>
                                <button class="ui primary button">Guardar</button>
                                <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                                <div class="ui error message"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.ui.form')
        .form({
            on: 'blur',
            fields: {
                password: {
                    rules: [
                        {
                            type   : 'notEmpty',
                            prompt : 'Contraseña no puede estar vacía'
                        }
                    ]
                },
                repetir_pwd: {
                    rules: [
                        {
                            type   : 'match[password]',
                            prompt : 'Las contraseñas deben coincidir'
                        }
                    ]
                },
            }
        })
    ;
</script>


