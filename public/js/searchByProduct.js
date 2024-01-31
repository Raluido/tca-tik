$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#inputSearch').on('keyup', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        let productSelected = $('#productsCounter').val();
        let inputSearch = $(this).val();
        $.ajax({
            url: url + '/storehousesManagement/' + inputSearch + '/searchBy',
            type: 'get',
            data: {},
            success: function (data) {
                console.log(data);
                data.forEach(element => {
                    $('#searchDropdown').append("<a href='" + url + "/storehousesManagement/" + storehouseSelected + "/" + categorySelected + "/" + productSelected + "/" + element.id + "/showBy" + " ' style='display:block; margin-bottom:.5em;'>" + element.name + "</a>");
                    $('#searchDropdown').removeClass('d-none');
                    $('#searchDropdown').addClass('d-block');
                });
            }
        })
    });
})