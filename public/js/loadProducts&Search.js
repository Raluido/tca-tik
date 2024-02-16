$(window).on('load', function () {

    let url = document.getElementById('url').value;

    $.ajax({
        type: 'GET',
        url: url + '/backoffice/storehousesManagement/showAllAjax',
        data: {},
        success: function (data) {
            fullFilledTable(data);
        }
    })

    $('#historic').on('change', function () {
        let inputSearch = $('#searchProductId').val();
        let historic = $(this).prop('checked');
        let offset = $('#offset').val();
        console.log(historic);
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showAllAjax/' + inputSearch + '/' + offset + '/' + historic,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#historicSelected').val(historic);
            }
        })
    })

    $('#inputSearch').on('keyup', function () {
        let inputSearch = $('#inputSearch').val();
        $.ajax({
            url: url + '/backoffice/storehousesManagement/searchBy/' + inputSearch,
            type: 'get',
            data: {},
            success: function (data) {
                if (typeof data === 'string') {
                    $('#searchDropdown').removeClass('d-block');
                    $('#searchDropdown').addClass('d-none');
                    reloadSearchEmpty();
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
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showAllAjax/' + inputSearch,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })
    })

    $('div').on('click', 'div#pages', function () {
        let inputSearch = $('#searchProductId').val();
        let offset = $(this)[0].getAttribute('data-offset');
        let historic = $('#historicSelected').val();
        $.ajax({
            type: 'GET',
            url: url + '/backoffice/storehousesManagement/showAllAjax/' + inputSearch + '/' + offset + '/' + historic,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#offset').val(offset);
            }
        })

    })

    function reloadSearchEmpty() {
        let inputSearch = 0;
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/showAllAjax/' + inputSearch,
            data: {},
            success: function (data) {
                fullFilledTable(data);
                $('#searchProductId').val(inputSearch);
            }
        })
    }

    function fullFilledTable(data) {
        $('.fullfilledTable').empty();
        let thead = document.createElement('thead');
        let tr = document.createElement('tr');
        thead.appendChild(tr);
        $('.fullfilledTable').append(thead);
        let thIdStr = document.createElement('th');
        thIdStr.innerHTML = 'Id';
        tr.appendChild(thIdStr);
        let thStorehouse = document.createElement('th');
        thStorehouse.innerHTML = 'Almacén';
        tr.appendChild(thStorehouse);
        let thSDescription = document.createElement('th');
        thSDescription.innerHTML = 'Descripción';
        tr.appendChild(thSDescription);
        let thIdPrd = document.createElement('th');
        thIdPrd.innerHTML = 'Id';
        tr.appendChild(thIdPrd);
        let thPName = document.createElement('th');
        thPName.innerHTML = 'Producto';
        tr.appendChild(thPName);
        let thPrice = document.createElement('th');
        thPrice.innerHTML = 'Precio';
        tr.appendChild(thPrice);
        let thCatPrd = document.createElement('th');
        thCatPrd.innerHTML = 'Categoría';
        tr.appendChild(thCatPrd);
        let thStocks = document.createElement('th');
        thStocks.innerHTML = 'Stock';
        tr.appendChild(thStocks);
        let thDate = document.createElement('th');
        thDate.innerHTML = 'Fecha';
        tr.appendChild(thDate);
        let tbody = document.createElement('tbody');
        $('.fullfilledTable').append(tbody);
        data.productsAll.forEach(function (element) {
            tr = document.createElement('tr');
            tbody.appendChild(tr);
            let tdSPrefix = document.createElement('td');
            tdSPrefix.innerHTML = element.sprefix;
            tr.appendChild(tdSPrefix);
            let tdSName = document.createElement('td');
            tdSName.innerHTML = element.sname;
            tr.appendChild(tdSName);
            let tdSDescription = document.createElement('td');
            tdSDescription.innerHTML = element.sdescription;
            tr.appendChild(tdSDescription);
            let tdPPrefix = document.createElement('td');
            tdPPrefix.innerHTML = element.pprefix;
            tr.appendChild(tdPPrefix);
            let tdPName = document.createElement('td');
            tdPName.innerHTML = element.pname;
            tr.appendChild(tdPName);
            let tdPrice = document.createElement('td');
            tdPrice.innerHTML = element.pprice;
            tr.appendChild(tdPrice);
            let tdPrdCategory = document.createElement('td');
            tdPrdCategory.innerHTML = element.cname;
            tr.appendChild(tdPrdCategory);
            let tdPrdTotal = document.createElement('td');
            tdPrdTotal.innerHTML = element.stock;
            tr.appendChild(tdPrdTotal);
            let tdDate = document.createElement('td');
            tdDate.innerHTML = element.updated_at;
            tr.appendChild(tdDate);
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
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer'><div id='pages' data-offset=" + (parseInt(data.offset) - 10) + "><</div></li>";
        }
        data.pagination.forEach(function (element) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='border-right:1px solid gray; cursor:pointer'><div id='pages' data-offset=" + element.offset + ">" + element.page + "</div></li>";
        })
        if ((parseInt(data.offset) + 10) < data.totalPrd) {
            paginates.innerHTML += "<li class='d-inline-block pe-auto' style='cursor:pointer;'><div id='pages' data-offset=" + (parseInt(data.offset) + 10) + ">></div></li>";
        }
        for (let item of paginates.children) if (item.children[0].getAttribute('data-offset') == offset.value) item.children[0].classList.add('bg-primary');
        $('.paginationMng').append(paginates);
    }
})