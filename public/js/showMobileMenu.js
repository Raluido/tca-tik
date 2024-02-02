$(window).on('load', function () {
    $('#mobileMenu').on('click', function () {
        if ($('#dropDownPrd').css('display') === 'block') {
            $('#dropDownPrd').css('display', 'none');
        }
        if ($('#dropDownStr').css('display') === 'block') {
            $('#dropDownStr').css('display', 'none');
        }
        if ($('#dropDownCat').css('display') === 'block') {
            $('#dropDownCat').css('display', 'none');
        }
        if ($('#dropDownMng').css('display') === 'block') {
            $('#dropDownMng').css('display', 'none');
        }
        $('#dropDown').toggle();
    })
    $('#subMenuPrd').on('click', function () {
        if ($('#dropDownStr').css('display') === 'block') {
            $('#dropDownStr').css('display', 'none');
        }
        if ($('#dropDownCat').css('display') === 'block') {
            $('#dropDownCat').css('display', 'none');
        }
        if ($('#dropDownMng').css('display') === 'block') {
            $('#dropDownMng').css('display', 'none');
        }
        $('#dropDownPrd').toggle();
    });
    $('#subMenuStr').on('click', function () {
        if ($('#dropDownPrd').css('display') === 'block') {
            $('#dropDownPrd').css('display', 'none');
        }
        if ($('#dropDownCat').css('display') === 'block') {
            $('#dropDownCat').css('display', 'none');
        }
        if ($('#dropDownMng').css('display') === 'block') {
            $('#dropDownMng').css('display', 'none');
        }
        $('#dropDownStr').toggle();
    });
    $('#subMenuCat').on('click', function () {
        if ($('#dropDownStr').css('display') === 'block') {
            $('#dropDownStr').css('display', 'none');
        }
        if ($('#dropDownPrd').css('display') === 'block') {
            $('#dropDownPrd').css('display', 'none');
        }
        if ($('#dropDownMng').css('display') === 'block') {
            $('#dropDownMng').css('display', 'none');
        }
        $('#dropDownCat').toggle();
    });
    $('#subMenuMng').on('click', function () {
        if ($('#dropDownStr').css('display') === 'block') {
            $('#dropDownStr').css('display', 'none');
        }
        if ($('#dropDownPrd').css('display') === 'block') {
            $('#dropDownPrd').css('display', 'none');
        }
        if ($('#dropDownCat').css('display') === 'block') {
            $('#dropDownCat').css('display', 'none');
        }
        $('#dropDownMng').toggle();
    });
})