$(window).on('load', function () {
    let nameErr = true;
    let priceErr = true;
    let prefixErr = true;
    let observationsErr = true;
    let descriptionErr = true;

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
            $('#nameError').text("El número de caracteres máximo es de 50.");
        }
    }

    $('#priceValidator').on('keyup', function () {
        priceValidator();
    })

    function priceValidator() {
        let priceVal = $('#priceValidator');
        let regex = /([1-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9])+\.[0-9]{2}/;
        if (regex.test(priceVal.val())) {
            priceVal.css('border', '1px solid green');
            $('#priceError').text('');
            priceErr = false;
            return priceErr;
        } else {
            priceVal.css('border', '1px solid red');
            $('#priceError').text("El rango del precio debe de estar entre los 0 y 9999,99 incluyendo dos decimales siempre.");
        }
    }

    function taxValidator() {
        let taxVal = $('#taxValidator');
        if (taxVal.val().length < 501) {
            taxVal.css('border', '1px solid green');
            $('#taxErr').text('');
            taxErr = false;
            return taxErr;
        } else {
            taxVal.css('border', '1px solid red');
            $('#taxValidator').text("El rango porcentual va de 0 a 100%.");
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

    $('#observationsValidator').on('keyup', function () {
        observationsValidator();
    })

    function observationsValidator() {
        let observationsVal = $('#observationsValidator');
        if (observationsVal.val().length < 501) {
            observationsVal.css('border', '1px solid green');
            $('#observationsError').text('');
            observationsErr = false;
            return observationsErr;
        } else {
            observationsVal.css('border', '1px solid red');
            $('#observationsError').text("El número maximo de caracteres es de 500.");
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
            $('#descriptionError').text("El número maximo de caracteres es de 500.");
        }
    }

    $('#submitBtn').on('click', function () {
        nameValidator();
        priceValidator();
        taxValidator();
        prefixValidator();
        observationsValidator();
        descriptionValidator();
        if (nameErr == false && prefixErr == false && priceErr == false && descriptionErr == false && observationsErr == false) {
            $('#sendForm').on('submit', function () {
                console.log("enviado");
            })
        } else {
            return false;
        }
    })
})