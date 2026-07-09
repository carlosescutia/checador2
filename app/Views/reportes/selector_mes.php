<form class="ui form" method="post" action="<?= $url_actual ?>">
    <div class="fields">
        <div class="field">
            <div class="ui selection long dropdown">
                <input type="hidden" name="mes" value="<?= $mes ?>" onchange="this.form.submit()">
                <i class="dropdown icon"></i>
                <div class="default text">mes</div>
                <div class="menu">
                    <div class="item" data-value="1">Enero</div>
                    <div class="item" data-value="2">Febrero</div>
                    <div class="item" data-value="3">Marzo</div>
                    <div class="item" data-value="4">Abril</div>
                    <div class="item" data-value="5">Mayo</div>
                    <div class="item" data-value="6">Junio</div>
                    <div class="item" data-value="7">Julio</div>
                    <div class="item" data-value="8">Agosto</div>
                    <div class="item" data-value="9">Septiembre</div>
                    <div class="item" data-value="10">Octubre</div>
                    <div class="item" data-value="11">Noviembre</div>
                    <div class="item" data-value="12">Diciembre</div>
                </div>
            </div>
        </div>
        <div class="field">
            <div class="ui selection long dropdown">
                <input type="hidden" name="anio" value="<?= $anio ?>" onchange="this.form.submit()">
                <i class="dropdown icon"></i>
                <div class="default text">año</div>
                <div class="menu">
                    <?php foreach ($anios_disponibles as $anios_disponibles_item): ?>
                        <div class="item" data-value="<?=$anios_disponibles_item['anio']?>"><?=$anios_disponibles_item['anio']?></div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</form>
