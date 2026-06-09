<div class="ui container">
    <div class="ui stackable grid">
        <div class="row">
            <div class="twelve wide column">
                <div class="row">
                    <h1 class="ui header">
                        Nuevo día inhábil
                        <button class="ui right floated primary button" type="submit" form="frm_dia_inhabil">Guardar</button>
                    </h1>
                </div>

                <div class="ui basic segment">
                    <form class="ui form" method="post" action="/dia_inhabil/guardar" id="frm_dia_inhabil">
                        <div class="four wide field">
                            <label>Fecha</label>
                            <input type="date" name="fecha" id="fecha">
                        </div>
                        <div class="ten wide field">
                            <label>Detalle</label>
                            <textarea name="detalle" id="detalle" rows="4"></textarea>
                        </div>

                        <div class="ui error message"></div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="ui basic segment">
                <a class="ui basic button" href="<?= site_url('incidentes') ?>">Volver</a>
            </div>
        </div>
    </div>
</div>

<script>
$('.ui.form')
    .form({
        fields: {
            fecha: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Fecha no puede estar vacio'
                    }
                ]
            },
            detalle: {
                rules: [
                    {
                        type   : 'notEmpty',
                        prompt : 'Detalle no puede estar vacio'
                    }
                ]
            },
        }
    })
;
</script>

