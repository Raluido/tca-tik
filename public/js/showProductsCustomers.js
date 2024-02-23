$(window).on('load', function () {
    let url = document.getElementById('url').value;
    let offset = $('#offset').val();

    $.ajax({
        url: url + '/showProductsAjax',
        type: "GET",
        data: {},
        success: function (data) {
            fullFilledTable(data);
        }
    })

    $('#filterByCat').on('change', function () {
        let offset = $('#offset').val();
        let searchProductId = $('#searchProductId').val();
        let category = $(this).val();
        $.ajax({
            url: url + '/showProductsAjax/' + category + '/' + searchProductId + '/' + offset,
            type: "GET",
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#categorySelected').val(category);
            }
        })
    })

    $('#inputSearch').on('keyup', function () {
        let inputSearch = $('#inputSearch').val();
        let categorySelected = $('#categorySelected').val();
        let offset = $('#offset').val();
        $.ajax({
            url: url + '/searchBy/' + inputSearch,
            type: 'get',
            data: {},
            success: function (data) {
                if (typeof data === 'string') {
                    $('#searchDropdown').removeClass('d-block');
                    $('#searchDropdown').addClass('d-none');
                    $('#searchProductId').val(0);
                    $.ajax({
                        type: 'GET',
                        url: url + '/showProductsAjax/' + categorySelected + '/' + 0 + '/' + offset,
                        data: {},
                        success: function (data) {
                            fullFilledTable(data);
                            $('#searchProductId').val(inputSearch);
                        }
                    })
                } else {
                    if (data[0] === undefined) {
                        $('#searchDropdown').html("<p style='display:block;'>No results</p>");
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    } else if (data[0] !== undefined) {
                        $('#searchDropdown').empty();
                        data.forEach(element => {
                            $('#searchDropdown').append("<div class='searchResults' data-id =" + element.id + " style='display:block; margin-bottom:.5em;'>" + element.name + "</div>");
                        })
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    }
                }
            }
        });
    })

    $('#searchDropdown').on('click', 'div.searchResults', function () {
        $('#searchDropdown').removeClass('d-block');
        $('#searchDropdown').addClass('d-none');
        let inputSearch = $(this).attr('data-id');
        let categorySelected = $('#categorySelected').val();
        $.ajax({
            type: 'GET',
            url: url + '/showProductsAjax/' + categorySelected + '/' + inputSearch + '/' + 0,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })

    })

    $('div').on('click', 'div#pages', function () {
        let inputSearch = $('#searchProductId').val();
        let categorySelected = $('#categorySelected').val();
        let offset = $(this)[0].getAttribute('data-offset');
        $.ajax({
            type: 'GET',
            url: url + '/showProductsAjax/' + categorySelected + '/' + inputSearch + '/' + offset,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#offset').val(offset);
            }
        })

    })
})

function fullFilledTable(data) {
    let url = document.getElementById('url').value;
    let cardsContainer = $('.cardsContainer');
    cardsContainer.empty();
    data.products.forEach(function (element) {
        let card = document.createElement('div');
        card.setAttribute('class', 'card');
        cardsContainer.append(card);
        let imageFilename = element.imageFilename;
        if (imageFilename !== null) {
            let carousel = document.createElement('div');
            carousel.setAttribute('class', 'carousel');
            card.appendChild(carousel);
            let images = imageFilename.split(',');
            for (let index = 1; index <= images.length; index++) {
                let input = document.createElement('input');
                input.setAttribute('type', 'radio');
                input.setAttribute('checked', 'checked');
                input.setAttribute('name', 'slides');
                input.setAttribute('id', "slide_" + index);
                carousel.appendChild(input);
            }
            let ul = document.createElement('ul');
            carousel.appendChild(ul);
            images.forEach(element1 => {
                let li = document.createElement('li');
                li.setAttribute('class', 'imgContainer');
                ul.appendChild(li);
                let img = document.createElement('img');
                img.setAttribute('src', url + '/images/' + element1);
                li.appendChild(img);
            });

        } else {
            let div = document.createElement('div');
            div.setAttribute('class', 'imgContainer');
            card.appendChild(div);
            let img = document.createElement('img');
            img.setAttribute('src', url + '/images/default.png');
            div.appendChild(img);
        }
        card.innerHTML += "<h4 class=''>" + element.pname + "</h4><p class=''>" + element.pdescription + "</p>" +
            "<h5 class=''>" + element.pprice + "€</h5>" +
            `${element.stockTotal == 0 ? "<p class='text-danger'>No hay stock</p>" : "<p class=''>" + element.stockTotal + " uds.</p>"}` +
            `${element.stockTotal != 0 ? "<div class='text-end'><button class='btn btn-success btn-sm' id='addToCart' data-id='" + element.id + "'>Añadir</button></div>" :
                "<div class='text-end'><button class='btn btn-success btn-sm' id='addToCart' data-id='" + element.id + "'disabled>Añadir</button></div>"}`;

        $('.paginationMng').empty();
        let showLefts = document.createElement('p');
        showLefts.innerHTML = "Showing <span class=''>" + (data.offset) + "</span> of <span class=''>" + data.totalPrd + "</span> results";
        $('.paginationMng').append(showLefts);
        let paginates = document.createElement('ul');
        paginates.style = 'display:inline-block';
        if (inputSearch == '') {
            inputSearch = 0;
        }
        if (parseInt(data.offset) > 0) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer; white-space:nowrap'><div id='pages' data-offset=" + (parseInt(data.offset) - 10) + "><</div></li>";
        }
        data.pagination.forEach(function (element) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer; white-space:nowrap'><div id='pages' data-offset=" + element.offset + ">" + element.page + "</div></li>";
        })
        if ((parseInt(data.offset) + 10) < data.totalPrd) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='cursor:pointer; white-space:nowrap;'><div id='pages' data-offset=" + (parseInt(data.offset) + 10) + ">></div></li>";
        }
        for (let item of paginates.children) if (item.children[0].getAttribute('data-offset') == offset.value) item.children[0].classList.add('bg-primary');
        $('.paginationMng').append(paginates);
    })
}