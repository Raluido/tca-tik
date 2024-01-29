$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#filterByStorehouse').on('change', function () {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#filterByCategory').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.href = url + '/storehousesManagement/showall';
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/filterBy/' + storehouseSelected + '/' + categorySelected,
            data: {},
            success: function () {
                window.location.href = url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected;
            }
        })
    })

    $('#filterByCategory').on('change', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.href = url + '/storehousesManagement/showall';
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/filterBy/' + storehouseSelected + '/' + categorySelected,
            data: {},
            success: function () {
                window.location.href = url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected;
            }
        })
    })
})