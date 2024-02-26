$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#addToCart').on('click', function () {
        let product = $(this).attr('data-id');
        $.ajax
            ({
                type: 'get',
                url: url + '/addToCart/' + product + '/' + 1,
                data: {},
                success: function (data) {

                }
            });
    })
})