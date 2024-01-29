$(window).on('load', function () {
    $('#addProductToStorehouse').on('click', function () {
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/ajaxCall1/' + $(this).data('str') + '/' + $(this).data('prd'),
            data: {},
            success: function () {

            }
        })
    })
})