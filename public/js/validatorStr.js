$(window).on('load', function () {
    let nameErr = true;
    let descriptionErr = true;
    let addressErr = true;
    let prefixErr = true;

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
            $('#nameError').text("El nombre del artículo debe de estar entre los 3 y los 25 caracteres");
        }
    }

    $('#prefixValidator').on('keyup', function () {
        prefixValidator();
    })

    function prefixValidator() {
        let prefixVal = $('#prefixValidator');
        if (1 < prefixVal.val().length && prefixVal.val().length < 5) {
            prefixVal.css('border', '1px solid green');
            $('#prefixError').text('');
            prefixErr = false;
            return prefixErr;
        } else {
            prefixVal.css('border', '1px solid red');
            $('#prefixError').text("El rango del prefijo debe de estar entre los 2 y 4.");
        }
    }

    $('#addressValidator').on('keyup', function () {
        addressValidator();
    })

    function addressValidator() {
        let addressVal = $('#addressValidator');
        if (4 < addressVal.val().length && addressVal.val().length < 101) {
            addressVal.css('border', '1px solid green');
            $('#addressError').text('');
            addressErr = false;
            return addressErr;
        } else {
            addressVal.css('border', '1px solid red');
            $('#addressError').text("El rango de la dirección debe de estar entre los 5 y 100 caracteres.");
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
            $('#descriptionError').text("El rango de la dirección debe de estar entre los 5 y 100 caracteres.");
        }
    }

    $('#submitBtn').on('click', function () {
        nameValidator();
        priceValidator();
        prefixValidator();
        observationsValidator();
        descriptionValidator();
        if (nameErr == false && prefixErr == false && priceErr == false && descriptionErr == false && observationsErr == false) {
            $('#sendForm').on('submit', function () {
            })
        } else {
            return false;
        }
    })
})