$(window).on('load', function () {
    $('#subDeskMenuPrd').on('mouseover', function () {
        if ($('#dropDownDeskStr').css('display') === 'block') {
            $('#dropDownDeskStr').css('display', 'none');
        }
        if ($('#dropDownDeskCat').css('display') === 'block') {
            $('#dropDownDeskCat').css('display', 'none');
        }
        if ($('#dropDownDeskMng').css('display') === 'block') {
            $('#dropDownDeskMng').css('display', 'none');
        }
        $('#dropDownDeskPrd').toggle();
    });
    $('#subDeskMenuStr').on('mouseover', function () {
        if ($('#dropDownDeskPrd').css('display') === 'block') {
            $('#dropDownDeskPrd').css('display', 'none');
        }
        if ($('#dropDownDeskCat').css('display') === 'block') {
            $('#dropDownDeskCat').css('display', 'none');
        }
        if ($('#dropDownDeskMng').css('display') === 'block') {
            $('#dropDownDeskMng').css('display', 'none');
        }
        $('#dropDownDeskStr').toggle();
    });
    $('#subDeskMenuCat').on('mouseover', function () {
        if ($('#dropDownDeskStr').css('display') === 'block') {
            $('#dropDownDeskStr').css('display', 'none');
        }
        if ($('#dropDownDeskPrd').css('display') === 'block') {
            $('#dropDownDeskPrd').css('display', 'none');
        }
        if ($('#dropDownDeskMng').css('display') === 'block') {
            $('#dropDownDeskMng').css('display', 'none');
        }
        $('#dropDownDeskCat').toggle();
    });
    $('#subDeskMenuMng').on('mouseover', function () {
        if ($('#dropDownDeskStr').css('display') === 'block') {
            $('#dropDownDeskStr').css('display', 'none');
        }
        if ($('#dropDownDeskPrd').css('display') === 'block') {
            $('#dropDownDeskPrd').css('display', 'none');
        }
        if ($('#dropDownDeskCat').css('display') === 'block') {
            $('#dropDownDeskCat').css('display', 'none');
        }
        $('#dropDownDeskMng').toggle();
    });
})