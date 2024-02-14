$(window).on('load', function () {

    let url = document.getElementById('url').value;

    $('#filterByStorehouse').on('change', function () {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#categorySelected').val();
        let inputSearch = $('#searchProductId').val();
        if (inputSearch == '') {
            inputSearch = 0;
        }
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/backoffice/storehousesManagement/showProducts');
            return;
        }
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch,
            data: {},
            success: function (data) {
                $('#offset').val(0);
                fullFilledTable(data);
                $('#storehouseSelected').val(storehouseSelected);
                if (storehouseSelected != 0 && $('#addNewPrd').hasClass('d-none')) {
                    $('#addNewPrd').removeClass('d-none');
                    $('#addNewPrd').addClass('d-block');
                } else {
                    $('#addNewPrd').removeClass('d-block');
                    $('#addNewPrd').addClass('d-none');
                }
                if ($('#inputSearch').hasClass('d-block') && $('#inputSearch1').hasClass('d-none')) {
                    $('#inputSearch').removeClass('d-block');
                    $('#inputSearch').addClass('d-none');
                    $('#inputSearch1').removeClass('d-none');
                    $('#inputSearch1').addClass('d-block');
                }
                $('#offset').val(0);
            }
        })
    })

    $('#filterByCategory').on('change', function () {
        let storehouseSelected = $('#storehouseSelected').val();
        let categorySelected = $('#filterByCategory').val();
        let inputSearch = $('#searchProductId').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/backoffice/storehousesManagement/showProducts');
            return;
        }
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch,
            data: {},
            success: function (data) {
                $('#offset').val(0);
                fullFilledTable(data);
                $('#categorySelected').val(categorySelected);
                if ($('#inputSearch').hasClass('d-block') && $('#inputSearch1').hasClass('d-none')) {
                    $('#inputSearch').removeClass('d-block');
                    $('#inputSearch').addClass('d-none');
                    $('#inputSearch1').removeClass('d-none');
                    $('#inputSearch1').addClass('d-block');
                }
            }
        })
    })

    $('#inputSearch1').on('keyup', function () {
        let inputSearch = $('#inputSearch1').val();
        $.ajax({
            url: url + '/backoffice/storehousesManagement/searchBy/' + inputSearch,
            type: 'get',
            data: {},
            success: function (data) {
                if (typeof data === 'string') {
                    $('#searchDropdown').removeClass('d-block');
                    $('#searchDropdown').addClass('d-none');
                } else {
                    if (data[0] === undefined) {
                        $('#searchDropdown').html("<p style='display:block;'>No results</p>");
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    } else if (data[0] !== undefined) {
                        $('#searchDropdown').empty();
                        data.forEach(element => {
                            $('#searchDropdown').append("<div class='searchResults1' data-id =" + element.id + " style='display:block; margin-bottom:.5em;'>" + element.name + "</div>");
                        })
                        $('#searchDropdown').removeClass('d-none');
                        $('#searchDropdown').addClass('d-block');
                    }
                }
            }
        });
    })

    $('#searchDropdown').on('click', 'div.searchResults1', function () {
        $('#searchDropdown').removeClass('d-block');
        $('#searchDropdown').addClass('d-none');
        let inputSearch = $(this).attr('data-id');
        let categorySelected = $('#categorySelected').val();
        let storehouseSelected = $('#storehouseSelected').val();
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })

    })

    $('div').on('click', 'div#pages1', function () {
        let inputSearch = $('#searchProductId').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let categorySelected = $('#categorySelected').val();
        let offset = $(this)[0].getAttribute('data-offset');
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#offset').val(offset);
            }
        })

    })

    function fullFilledTable(data) {
        $('.fullfilledTable').empty();
        let thead = document.createElement('thead');
        let tr = document.createElement('tr');
        thead.appendChild(tr);
        $('.fullfilledTable').append(thead);
        let thPrefix = document.createElement('th');
        thPrefix.innerHTML = 'id';
        tr.appendChild(thPrefix);
        let thName = document.createElement('th');
        thName.innerHTML = 'Almacén';
        tr.appendChild(thName);
        let thDcrp = document.createElement('th');
        thDcrp.innerHTML = 'Descripción';
        tr.appendChild(thDcrp);
        let thPrdId = document.createElement('th');
        thPrdId.innerHTML = 'Identificador del producto';
        tr.appendChild(thPrdId);
        let thPrd = document.createElement('th');
        thPrd.innerHTML = 'Productos';
        tr.appendChild(thPrd);
        let thPrdCat = document.createElement('th');
        thPrdCat.innerHTML = 'Categoría del producto';
        tr.appendChild(thPrdCat);
        let thPrice = document.createElement('th');
        thPrice.innerHTML = 'Precio';
        tr.appendChild(thPrice);
        let thqtt = document.createElement('th');
        thqtt.innerHTML = 'Cantidad';
        tr.appendChild(thqtt);
        let thstc = document.createElement('th');
        thstc.innerHTML = 'Stock';
        tr.appendChild(thstc);
        let tbody = document.createElement('tbody');
        $('.fullfilledTable').append(tbody);
        data.filtered.forEach(function (element) {
            tr = document.createElement('tr');
            tbody.appendChild(tr);
            let tdPrefix = document.createElement('td');
            tdPrefix.innerHTML = element.prefix;
            tr.appendChild(tdPrefix);
            let tdName = document.createElement('td');
            tdName.innerHTML = element.name;
            tr.appendChild(tdName);
            let tdDscrp = document.createElement('td');
            tdDscrp.innerHTML = element.description;
            tr.appendChild(tdDscrp);
            let tdPrdPrefix = document.createElement('td');
            tdPrdPrefix.innerHTML = element.pprefix;
            tr.appendChild(tdPrdPrefix);
            let tdPrdName = document.createElement('td');
            tdPrdName.innerHTML = element.pname;
            tr.appendChild(tdPrdName);
            let tdPrdCat = document.createElement('td');
            tdPrdCat.innerHTML = element.pcategory;
            tr.appendChild(tdPrdCat);
            let tdPrdPrice = document.createElement('td');
            tdPrdPrice.innerHTML = element.pprice;
            tr.appendChild(tdPrdPrice);
            let tdQtt = document.createElement('td');
            tdQtt.innerHTML = element.quantity;
            tr.appendChild(tdQtt);
            let tdStc = document.createElement('td');
            tdStc.innerHTML = element.stock;
            tr.appendChild(tdStc);
        })
        $('.paginationMng').empty();
        let showLefts = document.createElement('p');
        showLefts.innerHTML = "Showing <span class=''>" + (data.offset) + "</span> of <span class=''>" + data.totalPrd + "</span> results";
        $('.paginationMng').append(showLefts);
        let paginates = document.createElement('ul');
        paginates.setAttribute('class', 'text-center');
        if (inputSearch == '') {
            inputSearch = 0;
        }
        if (parseInt(data.offset) > 0) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer'><div id='pages1' data-offset=" + (parseInt(data.offset) - 10) + "><</div></li>";
        }
        data.pagination.forEach(function (element) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer'><div id='pages1' data-offset=" + element.offset + ">" + element.page + "</div></li>";
        })
        if ((parseInt(data.offset) + 10) < data.totalPrd) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='cursor:pointer;'><div id='pages1' data-offset=" + (parseInt(data.offset) + 10) + ">></div></li>";
        }
        for (let item of paginates.children) if (item.children[0].getAttribute('data-offset') == offset.value) item.children[0].classList.add('bg-primary');
        $('.paginationMng').append(paginates);
    }
})