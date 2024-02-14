$(window).on('load', function () {
    let nameErr = true;
    let prefixErr = true;
    let descriptionErr = true;
    let addressErr = true;

    $('#nameValidator').on('keyup', function () {
        nameValidator();
    })

    function nameValidator() {
        let nameVal = $('#nameValidator');
        if (nameVal.val().length < 51) {
            nameVal.css('border', '1px solid green');
            $('#nameError').text('');
            nameErr = false;
            return nameErr;
        } else {
            nameVal.css('border', '1px solid red');
            $('#nameError').text("El nombre de la categoría no debe contener más de 50 caracteres.");
        }
    }

    $('#prefixValidator').on('keyup', function () {
        prefixValidator();
    })

    function prefixValidator() {
        let prefixVal = $('#prefixValidator');
        if (0 < prefixVal.val().length && prefixVal.val().length < 4) {
            prefixVal.css('border', '1px solid green');
            $('#prefixError').text('');
            prefixErr = false;
            return prefixErr;
        } else {
            prefixVal.css('border', '1px solid red');
            $('#prefixError').text("El rango del prefijo debe de estar entre los 1 y 3.");
        }
    }

    $('#descriptionValidator').on('keyup', function () {
        descriptionValidator();
    })

    function descriptionValidator() {
        let descriptionVal = $('#descriptionValidator');
        if (descriptionVal.val().length < 501) {
            descriptionVal.css('border', '1px solid green');
            $('#descriptionError').text('');
            descriptionErr = false;
            return descriptionErr;
        } else {
            descriptionVal.css('border', '1px solid red');
            $('#descriptionError').text("La descripción del artículo no debe contener más de 500 caracteres.");
        }
    }

    $('#submitBtn').on('click', function () {
        nameValidator();
        prefixValidator();
        descriptionValidator();
        if (nameErr == false && prefixErr == false && descriptionErr == false && addressErr == false) {
            $('#sendForm').on('submit', function () {
            })
        } else {
            return false;
        }
    })
})