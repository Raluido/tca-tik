$(window).on('load', function () {
    $('#addProduct').on('click', function () {
        let data = $(this).parent().prev().children();
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/addToStorehouse/' + data.attr('data') + '/' + data.val(),
            data: {},
            success: function (data) {
                $('#counter').html(data);
            }
        })
    })

    $('#removeProduct').on('click', function () {
        let data = $(this).parent().prev().prev().children();
        console.log(data);
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/' + data.attr('data') + '/' + data.val() + '/delete',
            data: {},
            success: function (data) {
                $('#counter').html(data);
            }
        })
    })
})