$(window).on('load', function () {
    $('#nameValidator').on('keyup', function () {
        nameValidator();
    })

    function nameValidator() {
        let nameVal = $('#nameValidator');
        let nameError = true;
        if (2 < nameVal.val().length && nameVal.val().length < 26) {
            nameVal.css('border', '1px solid green');
            $('#nameError').text('');
            nameError = false;
            return false;
        } else {
            nameVal.css('border', '1px solid red');
            $('#nameError').text("El nombre del artículo debe de estar entre los 3 y los 25 caracteres");
        }
    }

    $('#priceValidator').on('keyup', function () {
        priceValidator();
    })

    function priceValidator() {
        let priceVal = $('#priceValidator');
        let regex = /([1-9]|[1-9][0-9]|[1-9][0-9][0-9]|[1-9][0-9][0-9][0-9])+\.[0-9]{2}/;
        let priceError = true;
        if (regex.test(priceVal.val())) {
            priceVal.css('border', '1px solid green');
            $('#priceError').text('');
            priceError = false;
            return false;
        } else {
            priceVal.css('border', '1px solid red');
            $('#priceError').text("El rango del precio debe de estar entre los 0 y 9999,99 incluyendo dos decimales siempre.");
        }
    }

    $('#prefixValidator').on('keyup', function () {
        prefixValidator();
    })

    function prefixValidator() {
        let prefixVal = $('#prefixValidator');
        let prefixError = true;
        if (0 < prefixVal.val().length && prefixVal.val().length < 4) {
            prefixVal.css('border', '1px solid green');
            $('#prefixError').text('');
            prefixError = false;
            return false;
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
        let observationsError = true;
        if (observationsVal.val().length < 101) {
            observationsVal.css('border', '1px solid green');
            $('#observationsError').text('');
            observationsError = false;
            return false;
        } else {
            observationsVal.css('border', '1px solid red');
            $('#observationsError').text("El número maximo de caracteres es de 100.");
        }
    }

    $('#descriptionValidator').on('keyup', function () {
        descriptionValidator();
    })

    function descriptionValidator() {
        let descriptionVal = $('#descriptionValidator');
        let descriptionError = true;
        if (descriptionVal.val().length < 501) {
            descriptionVal.css('border', '1px solid green');
            $('#descriptionError').text('');
            descriptionError = false;
            return false;
        } else {
            descriptionVal.css('border', '1px solid red');
            $('#descriptionError').text("El número maximo de caracteres es de 500.");
        }
    }

    $('#submitForm').on('click', function () {
        nameValidator();
        priceValidator();
        prefixValidator();
        observationsValidator();
        descriptionValidator();
        if (nameError == false && prefixError == false && priceError == false && descriptionError == false && observationsError == false) {
            return true;
        } else {
            return false;
        }
    })
})