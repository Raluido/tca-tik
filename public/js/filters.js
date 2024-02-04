$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#filterByStorehouse').on('change', function (e) {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#filterByCategory').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/storehousesManagement/showall');
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/filterBy/' + storehouseSelected + '/' + categorySelected,
            data: {},
            success: function () {
                window.location.assign(url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected);
                return;
            }
        })
    })

    $('#filterByCategory').on('change', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/storehousesManagement/showall');
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/filterBy/' + storehouseSelected + '/' + categorySelected,
            data: {},
            success: function () {
                window.location.assign(url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected);
                return;
            }
        })
    })
})