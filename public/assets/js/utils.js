function confirm_action(mensaje, forma) {
    $.modal({
        title: 'Confirme la acción',
        class: 'tiny',
        closeIcon: false,
        content: mensaje,
        actions: [
            {
                text: 'Confirmar',
                class: 'orange',
                click: function () {
                    $(forma).submit();
                }
            },
            {
                text: 'Cancelar',
                class: 'black'
            },
        ],
    }).modal('show');
}
