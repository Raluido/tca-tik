$(window).on('load', function () {
    let nameErr = true;
    let prefixErr = true;
    let descriptionErr = true;

    $('#nameValidator').on('keyup', function () {
        nameValidator();
    })

    function nameValidator() {
        let nameVal = $('#nameValidator');
        if (2 < nameVal.val().length && nameVal.val().length < 26) {
            nameVal.css('border', '1px solid green');
            $('#nameError').text('');
            nameErr = false;
            return nameErr;
        } else {
            nameVal.css('border', '1px solid red');
            $('#nameError').text("El nombre de la categoría debe de estar entre los 3 y los 25 caracteres");
        }
    }

    $('#prefixValidator').on('keyup', function () {
        prefixValidator();
    })

    function prefixValidator() {
        let prefixVal = $('#prefixValidator');
        if (1 < prefixVal.val().length && prefixVal.val().length < 4) {
            prefixVal.css('border', '1px solid green');
            $('#prefixError').text('');
            prefixErr = false;
            return prefixErr;
        } else {
            prefixVal.css('border', '1px solid red');
            $('#prefixError').text("El rango del prefijo debe de estar entre los 2 y 3.");
        }
    }

    $('#descriptionValidator').on('keyup', function () {
        descriptionValidator();
    })

    function descriptionValidator() {
        let descriptionVal = $('#descriptionValidator');
        if (4 < descriptionVal.val().length && descriptionVal.val().length < 101) {
            descriptionVal.css('border', '1px solid green');
            $('#descriptionError').text('');
            descriptionErr = false;
            return descriptionErr;
        } else {
            descriptionVal.css('border', '1px solid red');
            $('#descriptionError').text("El rango de la descriptión debe de estar entre los 5 y 100.");
        }
    }

    $('#submitBtn').on('click', function () {
        nameValidator();
        prefixValidator();
        descriptionValidator();
        if (nameErr == false && prefixErr == false && descriptionErr == false) {
            $('#sendForm').on('submit', function () {
            })
        } else {
            return false;
        }
    })
})