<form class="ui form" method="post" action="<?= $url_actual ?>">
    <div class="inline fields">
        <div class="eight wide field">
            <label>Desde</label>
            <input type="date" name="fech_ini" id="fech_ini" value="<?= $fech_ini ?>" onchange="this.form.submit()">
        </div>
        <div class="eight wide field">
            <label>hasta</label>
            <input type="date" name="fech_fin" id="fech_fin" value="<?= $fech_fin ?>" onchange="this.form.submit()">
        </div>
    </div>
</form>
