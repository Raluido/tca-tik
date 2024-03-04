$(window).on('load', function () {
    $('.deleteProduct').on('click', function () {
        if (confirm("Estas seguro de eliminar la ficha de producto? Si lo haces eliminarás las unidades en el almacén.")) {
            $.ajax({
                url: '/backoffice/products/' + $(this).val() + '/delete',
                type: 'get',
                data: {},
                success: function (data) {
                    if (data == 1) location.reload();
                    else alert("El producto que intenta eliminar se encuentra en algún proceso de venta o de compra, por tanto no podrá eliminarlo hasta que lo elimine de los almacenes.");
                }
            })
        }
    })

    $('.deleteCategory').on('click', function () {
        if (confirm("Estas seguro de eliminar la categoría? Si lo haces eliminarás las unidades de producto y la ficha del producto asociado.")) {
            $.ajax({
                url: '/backoffice/categories/' + $(this).val() + '/delete',
                type: 'get',
                data: {},
                success: function (data) {
                    if (data == 1) location.reload(data);
                    else alert("La categoría que intenta eliminar se encuentra asociada a algún producto, por tanto no podrá eliminarla hasta que la elimine de éstos.");
                }
            })
        }
    })

    $('.deleteStorehouse').on('click', function () {
        if (confirm("Estas seguro de eliminar el almacén? Si lo haces eliminarás las unidades de producto que contenga.")) {
            $.ajax({
                url: '/backoffice/storehouses/' + $(this).val() + '/delete',
                type: 'get',
                data: {},
                success: function (data) {
                    if (data == 1) location.reload(data);
                    else alert("El almacén que intenta eliminar se encuentra asociado a algún producto, por tanto no podrá eliminarlo hasta que la elimine de éstos.");
                }
            })
        }

    })
})