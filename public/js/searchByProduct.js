$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#inputSearch').on('keyup', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        let productSelected = $('#productsCounter').val();
        let inputSearch = $(this).val();
        $.ajax({
            url: url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected + '/' + inputSearch,
            type: 'get',
            data: {},
            success: function (data) {
                if (typeof data === 'string') {
                    $('#searchDropdown').removeClass('d-block');
                    $('#searchDropdown').addClass('d-none');
                } else {
                    if (data[0] === undefined) {
                        $('#searchDropdown').html("<p style='display:block;'>No results</p>");
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    } else if (data[0] !== undefined) {
                        $('#searchDropdown').empty();
                        data.forEach(element => {
                            $('#searchDropdown').append("<a href='" + url + "/storehousesManagement/showBy/" + storehouseSelected + "/" + categorySelected + "/" + productSelected + "/" + element.id + " ' style='display:block; margin-bottom:.5em;'>" + element.name + "</a>");
                        })
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    }
                }
            }
        });
    })
})