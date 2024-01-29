$(window).on('load', function () {
    $('#filterByStorehouse').on('change', function () {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#filterByCategory').val();
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/ajaxCall/' + storehouseSelected + '/' + categorySelected,
            data: {},
            success: function () {
                window.location.href = 'http://tca-tik.com.devel/storehousesManagement/showByStorehouse/' + storehouseSelected + '/' + categorySelected;
            }
        })
    })

    $('#filterByCategory').on('change', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/ajaxCall/' + categorySelected + '/' + storehouseSelected,
            data: {},
            success: function () {
                console.log('aqui');
                window.location.href = 'http://tca-tik.com.devel/storehousesManagement/showByCategory/' + categorySelected + '/' + storehouseSelected;
            }
        })
    })
})