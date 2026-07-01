<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nuevo horario
                        <button class="ui right floated primary button" type="submit" form="frm_horario">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/horario/guardar" id="frm_horario">
                        <div class="fields">
                            <div class="four wide field">
                                <label>Fecha inicial</label>
                                <input type="date" name="fech_ini" id="fech_ini">
                            </div>
                            <div class="four wide field">
                                <label>Fecha final</label>
                                <input type="date" name="fech_fin" id="fech_fin">
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
                                        <tr>
                                            <td>Lunes</td>
                                            <td><input type="time" name="1_hora_entrada" value="<?=$entrada_estandar?>"></td>
                                            <td><input type="time" name="1_hora_salida" value="<?=$salida_estandar?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Martes</td>
                                            <td><input type="time" name="2_hora_entrada" value="<?=$entrada_estandar?>"></td>
                                            <td><input type="time" name="2_hora_salida" value="<?=$salida_estandar?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Miércoles</td>
                                            <td><input type="time" name="3_hora_entrada" value="<?=$entrada_estandar?>"></td>
                                            <td><input type="time" name="3_hora_salida" value="<?=$salida_estandar?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Jueves</td>
                                            <td><input type="time" name="4_hora_entrada" value="<?=$entrada_estandar?>"></td>
                                            <td><input type="time" name="4_hora_salida" value="<?=$salida_estandar?>"></td>
                                        </tr>
                                        <tr>
                                            <td>Viernes</td>
                                            <td><input type="time" name="5_hora_entrada" value="<?=$entrada_estandar?>"></td>
                                            <td><input type="time" name="5_hora_salida" value="<?=$salida_estandar?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="hidden" name="id_empleado" id="id_empleado" value="<?= $id_empleado ?>">

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

