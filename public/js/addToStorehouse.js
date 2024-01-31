$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#addProduct').on('click', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        let productSelected = $('#productsCounter').val();
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/addToStorehouse/' + $('#filterByStorehouse').val() + '/' + $('#productsCounter').val(),
            data: {},
            success: function (data) {
                window.location.href = url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected;
            }
        })
    })

    $('#removeProduct').on('click', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        let productSelected = $('#productsCounter').val();
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/' + $('#filterByStorehouse').val() + '/' + $('#productsCounter').val() + '/delete',
            data: {},
            success: function (data) {
                window.location.href = url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected;
            }
        })
    })
})