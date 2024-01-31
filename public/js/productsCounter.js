$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    });
    $.ajax({
        type: 'post',
        url: url + '/storehousesManagement/productsCounter',
        data: { storehouseId: $('#filterByStorehouse').val(), productId: $('#productsCounter').val() },
        success: function (data) {
            $('#counter').html(data);
        }
    });

    $('#productsCounter').on('change', function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        });
        $.ajax({
            type: 'post',
            url: url + '/storehousesManagement/productsCounter',
            data: { storehouseId: $('#filterByStorehouse').val(), productId: $('#productsCounter').val() },
            success: function (data) {
                $('#counter').html(data);
            }
        });
    })
})