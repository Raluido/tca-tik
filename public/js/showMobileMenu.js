$(window).on('load', function () {
    $('#mobileMenu').on('click', function () {
        if ($('#dropDownPrd').hasClass('d-block')) {
            $('#dropDownPrd').removeClass('d-block');
            $('#dropDownPrd').addClass('d-none');
        }
        if ($('#dropDownStr').hasClass('d-block')) {
            $('#dropDownStr').removeClass('d-block');
            $('#dropDownStr').addClass('d-none');
        }
        if ($('#dropDownCat').hasClass('d-block')) {
            $('#dropDownCat').removeClass('d-block');
            $('#dropDownCat').addClass('d-none');
        }
        if ($('#dropDownMng').hasClass('d-block')) {
            $('#dropDownMng').removeClass('d-block');
            $('#dropDownMng').addClass('d-none');
        }
        if ($('#dropDown').hasClass('d-none')) {
            $('#dropDown').removeClass('d-none');
            $('#dropDown').addClass('d-block');
        } else {
            $('#dropDown').removeClass('d-block');
            $('#dropDown').addClass('d-none');
        }
    })
    $('#subMenuPrd').on('click', function () {
        if ($('#dropDownStr').hasClass('d-block')) {
            $('#dropDownStr').removeClass('d-block');
            $('#dropDownStr').addClass('d-none');
        }
        if ($('#dropDownCat').hasClass('d-block')) {
            $('#dropDownCat').removeClass('d-block');
            $('#dropDownCat').addClass('d-none');
        }
        if ($('#dropDownMng').hasClass('d-block')) {
            $('#dropDownMng').removeClass('d-block');
            $('#dropDownMng').addClass('d-none');
        }
        if ($('#dropDownPrd').hasClass('d-none')) {
            $('#dropDownPrd').removeClass('d-none');
            $('#dropDownPrd').addClass('d-block');
        } else {
            $('#dropDownPrd').removeClass('d-block');
            $('#dropDownPrd').addClass('d-none');
        }
    })
    $('#subMenuStr').on('click', function () {
        if ($('#dropDownPrd').hasClass('d-block')) {
            $('#dropDownPrd').removeClass('d-block');
            $('#dropDownPrd').addClass('d-none');
        }
        if ($('#dropDownCat').hasClass('d-block')) {
            $('#dropDownCat').removeClass('d-block');
            $('#dropDownCat').addClass('d-none');
        }
        if ($('#dropDownMng').hasClass('d-block')) {
            $('#dropDownMng').removeClass('d-block');
            $('#dropDownMng').addClass('d-none');
        }
        if ($('#dropDownStr').hasClass('d-none')) {
            $('#dropDownStr').removeClass('d-none');
            $('#dropDownStr').addClass('d-block');
        } else {
            $('#dropDownStr').removeClass('d-block');
            $('#dropDownStr').addClass('d-none');
        }
    });
    $('#subMenuCat').on('click', function () {
        if ($('#dropDownPrd').hasClass('d-block')) {
            $('#dropDownPrd').removeClass('d-block');
            $('#dropDownPrd').addClass('d-none');
        }
        if ($('#dropDownMng').hasClass('d-block')) {
            $('#dropDownMng').removeClass('d-block');
            $('#dropDownMng').addClass('d-none');
        }
        if ($('#dropDownStr').hasClass('d-block')) {
            $('#dropDownStr').removeClass('d-block');
            $('#dropDownStr').addClass('d-none');
        }
        if ($('#dropDownCat').hasClass('d-none')) {
            $('#dropDownCat').removeClass('d-none');
            $('#dropDownCat').addClass('d-block');
        } else {
            $('#dropDownCat').removeClass('d-block');
            $('#dropDownCat').addClass('d-none');
        }
    });
    $('#subMenuMng').on('click', function () {
        if ($('#dropDownPrd').hasClass('d-block')) {
            $('#dropDownPrd').removeClass('d-block');
            $('#dropDownPrd').addClass('d-none');
        }
        if ($('#dropDownCat').hasClass('d-block')) {
            $('#dropDownCat').removeClass('d-block');
            $('#dropDownCat').addClass('d-none');
        }
        if ($('#dropDownStr').hasClass('d-block')) {
            $('#dropDownStr').removeClass('d-block');
            $('#dropDownStr').addClass('d-none');
        }
        if ($('#dropDownMng').hasClass('d-none')) {
            $('#dropDownMng').removeClass('d-none');
            $('#dropDownMng').addClass('d-block');
        } else {
            $('#dropDownMng').removeClass('d-block');
            $('#dropDownMng').addClass('d-none');
        }
    });
})