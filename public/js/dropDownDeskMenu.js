$(window).on('load', function () {
    $('#subDeskMenuPrd').on('mouseover', function () {
        if ($('#dropDownDeskStr').hasClass('d-block')) {
            $('#dropDownDeskStr').removeClass('d-block');
            $('#dropDownDeskStr').addClass('d-none');
        }
        if ($('#dropDownDeskCat').hasClass('d-block')) {
            $('#dropDownDeskCat').removeClass('d-block');
            $('#dropDownDeskCat').addClass('d-none');
        }
        if ($('#dropDownDeskMng').hasClass('d-block')) {
            $('#dropDownDeskMng').removeClass('d-block');
            $('#dropDownDeskMng').addClass('d-none');
        }
        if ($('#dropDownDeskPrd').hasClass('d-none')) {
            $('#dropDownDeskPrd').removeClass('d-none');
            $('#dropDownDeskPrd').addClass('d-block');
        }
    });
    $('#subDeskMenuStr').on('mouseover', function () {
        if ($('#dropDownDeskPrd').hasClass('d-block')) {
            $('#dropDownDeskPrd').removeClass('d-block');
            $('#dropDownDeskPrd').addClass('d-none');
        }
        if ($('#dropDownDeskCat').hasClass('d-block')) {
            $('#dropDownDeskCat').removeClass('d-block');
            $('#dropDownDeskCat').addClass('d-none');
        }
        if ($('#dropDownDeskMng').hasClass('d-block')) {
            $('#dropDownDeskMng').removeClass('d-block');
            $('#dropDownDeskMng').addClass('d-none');
        }
        if ($('#dropDownDeskStr').hasClass('d-none')) {
            $('#dropDownDeskStr').removeClass('d-none');
            $('#dropDownDeskStr').addClass('d-block');
        }
    });
    $('#subDeskMenuCat').on('mouseover', function () {
        if ($('#dropDownDeskStr').hasClass('d-block')) {
            $('#dropDownDeskStr').removeClass('d-block');
            $('#dropDownDeskStr').addClass('d-none');
        }
        if ($('#dropDownDeskPrd').hasClass('d-block')) {
            $('#dropDownDeskPrd').removeClass('d-block');
            $('#dropDownDeskPrd').addClass('d-none');
        }
        if ($('#dropDownDeskMng').hasClass('d-block')) {
            $('#dropDownDeskMng').removeClass('d-block');
            $('#dropDownDeskMng').addClass('d-none');
        }
        if ($('#dropDownDeskCat').hasClass('d-none')) {
            $('#dropDownDeskCat').removeClass('d-none');
            $('#dropDownDeskCat').addClass('d-block');
        }
    });
    $('#subDeskMenuMng').on('mouseover', function () {
        if ($('#dropDownDeskStr').hasClass('d-block')) {
            $('#dropDownDeskStr').removeClass('d-block');
            $('#dropDownDeskStr').addClass('d-none');
        }
        if ($('#dropDownDeskCat').hasClass('d-block')) {
            $('#dropDownDeskCat').removeClass('d-block');
            $('#dropDownDeskCat').addClass('d-none');
        }
        if ($('#dropDownDeskPrd').hasClass('d-block')) {
            $('#dropDownDeskPrd').removeClass('d-block');
            $('#dropDownDeskPrd').addClass('d-none');
        }
        if ($('#dropDownDeskMng').hasClass('d-none')) {
            $('#dropDownDeskMng').removeClass('d-none');
            $('#dropDownDeskMng').addClass('d-block');
        }
    });
})