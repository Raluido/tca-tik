$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('.thumbnailDelete').on('click', function () {
        let imageId = $(this).attr('data-id');
        $.ajax({
            url: url + '/backoffice/products/image/' + imageId + '/delete',
            type: 'GET',
            success: function (data) {
                if (data == 1) location.reload();
            }
        })
    })
})