$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#addToCartOne').on('click', function () {
        let product = $(this).attr('data-id');
        $.ajax
            ({
                type: 'get',
                url: url + '/addToCart/' + product + '/' + 1,
                data: {},
                success: function (data) {
                    $('#cartItemAmount').val(data);
                }
            });
    })

    $('#removeFromCartOne').on('click', function () {
        let product = $(this).attr('data-id');
        $.ajax
            ({
                type: 'get',
                url: url + '/removeFromCart/' + product + '/' + (-1),
                data: {},
                success: function (data) {
                    $('#cartItemAmount').val(data);
                }
            });
    })

    $('#cartItemAmount').on("keypress", function (event) {
        let product = $(this).attr('data-id');
        if (event.which == 13) {
            event.preventDefault();
            $.ajax({
                type: 'get',
                url: url + '/addToCart/' + product + '/' + $(this).val(),
                data: {},
                success: function (data) {

                }
            })
        }
    })
})