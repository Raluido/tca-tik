$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('.deleteProduct').on('click', function () {
        console.log($(this).val());
        if (confirm("Estas seguro de eliminar la ficha de producto? Si lo haces eliminarás las unidades en el almacén.")) {
            $.ajax({
                url: '/products/' + $(this).val() + '/delete/',
                type: 'get',
                data: {},
                success: function () {
                    location.reload();
                }
            })
        }

    })
})