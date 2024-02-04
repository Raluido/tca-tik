$(window).on('load', function () {
    $('.deleteProduct').on('click', function () {
        if (confirm("Estas seguro de eliminar la ficha de producto? Si lo haces eliminarás las unidades en el almacén.")) {
            $.ajax({
                url: '/products/delete' + $(this).val(),
                type: 'get',
                data: {},
                success: function () {
                    location.reload();
                }
            })
        }

    })

    $('.deleteCategory').on('click', function () {
        if (confirm("Estas seguro de eliminar la categoría? Si lo haces eliminarás las unidades de producto y la ficha del producto asociado.")) {
            $.ajax({
                url: '/categories/delete/' + $(this).val(),
                type: 'get',
                data: {},
                success: function () {
                    location.reload();
                }
            })
        }

    })

    $('.deleteStorehouse').on('click', function () {
        if (confirm("Estas seguro de eliminar el almacén? Si lo haces eliminarás las unidades de producto que contenga.")) {
            $.ajax({
                url: '/storehouses/delete/' + $(this).val(),
                type: 'get',
                data: {},
                success: function () {
                    location.reload();
                }
            })
        }

    })
})