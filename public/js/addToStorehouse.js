$(window).on('load', function () {
    $('#addProduct').on('click', function () {
        console.log($(this).prev('div').children().val());
    })
})