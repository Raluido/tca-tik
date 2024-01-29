$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#inputSearch').on('keydown', function () {
        $.ajax({
            url: url + '/' + $(this).val(),
            type: 'get',
            data: {},
            success: function () {
                console.log("aqui");
            }
        })
    });
})