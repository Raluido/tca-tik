$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('.thumbnailDelete').on('click', function () {
        let dataId = $(this).attr('data-id');
        $.ajax({
            url: url + '/backoffice/products/image/' + dataId + '/delete',
            type: 'GET',
            success: function (data) {
            }
        })
    })
})