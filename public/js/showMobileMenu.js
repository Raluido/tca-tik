$(window).on('load', function () {
    $('#mobileMenu').on('click', function () {
        $('#dropDown').toggle();
    })
    $('#subMenuPrd').on('click', function () {
        $('#dropDownPrd').toggle();
    });
    $('#subMenuStr').on('click', function () {
        $('#dropDownStr').toggle();
    });
    $('#subMenuCat').on('click', function () {
        $('#dropDownCat').toggle();
    });
    $('#subMenuMng').on('click', function () {
        $('#dropDownMng').toggle();
    });
})