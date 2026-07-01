<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Editar horario
                        <button class="ui right floated primary button" type="submit" form="frm_horario">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/horario/guardar" id="frm_horario">
                        <div class="fields">
                            <div class="four wide field">
                                <label>Fecha inicial</label>
                                <input type="date" name="fech_ini" id="fech_ini" value="<?= $horario['fech_ini'] ?>">
                            </div>
                            <div class="four wide field">
                                <label>Fecha final</label>
                                <input type="date" name="fech_fin" id="fech_fin" value="<?= $horario['fech_fin'] ?>">
                            </div>
                        </div>

                        <div class="ui hidden divider"></div>

                        <div class="ui grid">
                            <div class="eight wide column">
                                <table class="ui very basic table"
                                    <thead>
                                        <tr>
                                            <th>dia</th>
                                            <th>hora de entrada</th>
                                            <th>hora de salida</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($horario_dias as $horario_dias_item): ?>
                                        <tr>
                                            <td><?= $horario_dias_item['nom_dia'] ?></td>
                                            <td><input type="time" name="<?=$horario_dias_item['id_dia']?>_hora_entrada" value="<?= $horario_dias_item['hora_entrada'] ?>"></td>
                                            <td><input type="time" name="<?=$horario_dias_item['id_dia']?>_hora_salida" value="<?= $horario_dias_item['hora_salida'] ?>"></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?= $id_empleado ?>">
                        <input type="hidden" name="id_horario" id="id_horario" value="<?= $horario['id_horario'] ?>">

                        <div class="ui error message"></div>
                    </form>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('empleado/detalle/'.$id_empleado) ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            fech_ini: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Fecha inicial no puede estar vacio'
                    }
                ]
            },
            fech_fin: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Fecha final no puede estar vacio'
                    }
                ]
            },
        }
    });
</script>


