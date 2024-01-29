$(window).on('load', function () {
    $('#addProductToStorehouse').on('click', function () {
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/addToStorehouse/' + $(this).data('str') + '/' + $(this).data('prd'),
            data: {},
            success: function () {

            }
        })
    })
})