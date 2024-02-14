$(window).on('load', function () {
    let nameErr = true;
    let priceErr = true;
    let prefixErr = true;
    let taxErr = true;
    let observationsErr = true;
    let descriptionErr = true;
    let imagesErr = true;

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
        let regex = new RegExp('^\s*?[0-9]{1,4}\.[0-9]{2}\s*$');
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

    $('#taxValidator').on('keyup', function () {
        taxValidator();
    })

    function taxValidator() {
        let taxVal = $('#taxValidator');
        let regex = new RegExp('^\s*?[0-9]{1,2}\.[0-9]{2}\s*$');
        if (regex.test(taxVal.val())) {
            taxVal.css('border', '1px solid green');
            $('#taxError').text('');
            taxErr = false;
            return taxErr;
        } else {
            taxVal.css('border', '1px solid red');
            $('#taxError').text("El rango porcentual va de 0 a 100%.");
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

    $('#images').on('change', () => {
        imagesValidator();
    });

    function imagesValidator() {
        let imagesVal = $('#images');
        let images = imagesVal.prop('files');
        let allowFormats = [
            'image/jpg', 'image/jpeg', 'image/png'
        ];

        if (images.length == 0) {
            $('#imagesError').text("No has añadido ninguna imágen o imágenes al producto.");
        }

        else {
            for (let index = 0; index < images.length; index++) {
                let element = images[index];
                if (!allowFormats.includes(element.type)) {
                    imagesVal.css('border', '1px solid red');
                    $('#imagesError').text("Alguno de los archivos que intentas añadir no tiene extensión jpg, jpeg o png.");
                } else {
                    $('#imagesError').text('');
                    imagesVal.css('border', '1px solid green');
                    imagesErr = false;
                    return imagesErr;
                }
            }
        }
    }

    $('#submitBtn').on('click', function () {
        nameValidator();
        priceValidator();
        taxValidator();
        prefixValidator();
        observationsValidator();
        descriptionValidator();
        imagesValidator();
        if (nameErr == false && prefixErr == false && priceErr == false && taxErr == false && descriptionErr == false && observationsErr == false && imagesErr == false) {
            $('#sendForm').on('submit', function () {
                console.log("enviado");
            })
        } else {
            return false;
        }
    })
})