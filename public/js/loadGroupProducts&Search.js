$(window).on('load', function () {

    let url = document.getElementById('url').value;

    $.ajax({
        type: 'GET',
        url: url + '/backoffice/storehousesManagement/showFilteredAjax',
        data: {},
        success: function (data) {
            fullFilledTable(data);
        }
    })

    $('body').on('change', 'select#productSelected', function () {
        let categorySelected = $('#categorySelected').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let inputSearch = $(this).val();
        let historic = $('#historic').prop('checked');
        let offset = $('#offset').val();
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset + '/' + historic,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })
    })

    $('#historic').on('change', function () {
        let inputSearch = $('#searchProductId').val();
        let categorySelected = $('#categorySelected').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let historic = $('#historic').prop('checked');
        let offset = $('#offset').val();
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset + '/' + historic,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#historicSelected').val(historic);
            }
        })
    })

    $('#filterByStorehouse').on('change', function () {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#categorySelected').val();
        let inputSearch = $('#searchProductId').val();
        let historic = $('#historic').prop('checked');
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + 0 + '/' + historic,
            data: {},
            success: function (data) {
                $('#offset').val(0);
                (storehouseSelected != 0) ? addNewPrd(data) : $('#addNewPrd').empty() && $('#addNewPrd').attr('class', '');
                fullFilledTable(data);
                $('#storehouseSelected').val(storehouseSelected);
                $('#offset').val(0);
            }
        })
    })

    $('#filterByCategory').on('change', function () {
        let storehouseSelected = $('#storehouseSelected').val();
        let categorySelected = $('#filterByCategory').val();
        let inputSearch = $('#searchProductId').val();
        let historic = $('#historic').prop('checked');
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + 0 + '/' + historic,
            data: {},
            success: function (data) {
                $('#offset').val(0);
                fullFilledTable(data);
                $('#categorySelected').val(categorySelected);
            }
        })
    })

    $('#inputSearch').on('keyup', function () {
        let inputSearch = $('#inputSearch').val();
        let categorySelected = $('#categorySelected').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let historic = $('#historic').prop('checked');
        let offset = $('#offset').val();
        $.ajax({
            url: url + '/backoffice/storehousesManagement/searchBy/' + inputSearch,
            type: 'get',
            data: {},
            success: function (data) {
                if (typeof data === 'string') {
                    $('#searchDropdown').removeClass('d-block');
                    $('#searchDropdown').addClass('d-none');
                    $('#searchProductId').val(0);
                    $.ajax({
                        type: 'GET',
                        url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + 0 + '/' + offset + '/' + historic,
                        data: {},
                        success: function (data) {
                            fullFilledTable(data);
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
        let storehouseSelected = $('#storehouseSelected').val();
        let historic = $('#historic').prop('checked');
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + 0 + '/' + historic,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })

    })

    $('div').on('click', 'div#pages', function () {
        let inputSearch = $('#searchProductId').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let categorySelected = $('#categorySelected').val();
        let offset = $(this)[0].getAttribute('data-offset');
        let historic = $('#historic').prop('checked');
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showFilteredAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset + '/' + historic,
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
        thPrefix.innerHTML = 'Id';
        tr.appendChild(thPrefix);
        let thName = document.createElement('th');
        thName.innerHTML = 'Almacén';
        tr.appendChild(thName);
        let thDcrp = document.createElement('th');
        thDcrp.innerHTML = 'Descripción';
        tr.appendChild(thDcrp);
        let thPrdId = document.createElement('th');
        thPrdId.innerHTML = 'Id';
        tr.appendChild(thPrdId);
        let thPrd = document.createElement('th');
        thPrd.innerHTML = 'Producto';
        tr.appendChild(thPrd);
        let thPrice = document.createElement('th');
        thPrice.innerHTML = 'Precio';
        tr.appendChild(thPrice);
        let thPrdCat = document.createElement('th');
        thPrdCat.innerHTML = 'Categoría';
        tr.appendChild(thPrdCat);
        let thstc = document.createElement('th');
        thstc.innerHTML = 'Stock';
        tr.appendChild(thstc);
        let thUpdated = document.createElement('th');
        thUpdated.innerHTML = 'Fecha';
        tr.appendChild(thUpdated);
        let tbody = document.createElement('tbody');
        $('.fullfilledTable').append(tbody);
        data.filtered.forEach(function (element) {
            tr = document.createElement('tr');
            tbody.appendChild(tr);
            let tdPrefix = document.createElement('td');
            tdPrefix.innerHTML = element.sprefix;
            tr.appendChild(tdPrefix);
            let tdName = document.createElement('td');
            tdName.innerHTML = element.sname;
            tr.appendChild(tdName);
            let tdDscrp = document.createElement('td');
            tdDscrp.innerHTML = element.sdescription;
            tr.appendChild(tdDscrp);
            let tdPrdPrefix = document.createElement('td');
            tdPrdPrefix.innerHTML = element.pprefix;
            tr.appendChild(tdPrdPrefix);
            let tdPrdName = document.createElement('td');
            tdPrdName.innerHTML = element.pname;
            tr.appendChild(tdPrdName);
            let tdPrdPrice = document.createElement('td');
            tdPrdPrice.innerHTML = element.pprice;
            tr.appendChild(tdPrdPrice);
            let tdPrdCat = document.createElement('td');
            tdPrdCat.innerHTML = element.cname;
            tr.appendChild(tdPrdCat);
            let tdStc = document.createElement('td');
            tdStc.innerHTML = element.stock;
            tr.appendChild(tdStc);
            let tdUpdated = document.createElement('td');
            tdUpdated.innerHTML = element.updated_at;
            tr.appendChild(tdUpdated);
        })
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
    }

    function addNewPrd(data) {
        $('#addNewPrd').empty();
        $('#addNewPrd').css('overflow-x', 'auto');
        $('#addNewPrd').attr('class', 'shadow-lg mb-5 p-5');
        let h4 = document.createElement('h4');
        h4.innerHTML = "Añadir producto";
        h4.setAttribute('class', 'mb-5 text-center');
        $('#addNewPrd').append(h4);
        let tableAddPrd = document.createElement('table');
        tableAddPrd.setAttribute('class', 'table');
        $('#addNewPrd').append(tableAddPrd);
        let thead = document.createElement('thead');
        tableAddPrd.appendChild(thead);
        let tr = document.createElement('tr');
        thead.appendChild(tr);
        let thProduct = document.createElement('th');
        thProduct.innerHTML = 'Producto';
        tr.appendChild(thProduct);
        let thAction = document.createElement('th');
        thAction.innerHTML = 'Acción';
        tr.appendChild(thAction);
        let thPrice = document.createElement('th');
        thPrice.innerHTML = 'Precio';
        tr.appendChild(thPrice);
        let thQuantity = document.createElement('th');
        thQuantity.innerHTML = 'Cantidad';
        tr.appendChild(thQuantity);
        let tbody = document.createElement('tbody');
        tableAddPrd.appendChild(tbody);
        tr = document.createElement('tr');
        tbody.appendChild(tr);
        let tdSelectContainer = document.createElement('td');
        tr.appendChild(tdSelectContainer);
        let tdSelect = document.createElement('select');
        tdSelect.setAttribute('id', 'productSelected');
        tdSelectContainer.appendChild(tdSelect);
        let inputSearchId = $('#searchProductId').val();
        data.products.forEach(function (element) {
            if (element.id == inputSearchId) {
                tdSelect.innerHTML += "<option value='" + element.id + "'selected='selected'>" + element.name + "</option>";
            } else {
                tdSelect.innerHTML += "<option value=" + element.id + ">" + element.name + "</option>";
            }
        })
        let tdAction = document.createElement('td');
        tdAction.innerHTML = "<input type=text id='action' class=''>";
        tr.appendChild(tdAction);
        let tdPrice = document.createElement('td');
        tdPrice.innerHTML = "<input type=text id='price' class=''>";
        tr.appendChild(tdPrice);
        let tdQuantity = document.createElement('td');
        tdQuantity.innerHTML = "<input type=text id='quantity' class=''>";
        tr.appendChild(tdQuantity);
        let tdButtons = document.createElement('td');
        tdButtons.innerHTML = "<button id='addProductsBtn' class='btn btn-success btn-sm me-3'>Añadir</button><button id='removeProductBtn' class='btn btn-danger btn-sm'>Quitar</button>";
        tr.appendChild(tdButtons);
    }
})