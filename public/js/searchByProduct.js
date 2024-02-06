$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#inputSearch').on('keyup', function () {
        let inputSearch = $('#inputSearch').val();
        $.ajax({
            url: url + '/storehousesManagement/searchBy/' + inputSearch,
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
            url: '/storehousesManagement/showAllAjax/' + inputSearch,
            data: {},
            success: function (data) {
                $('.fullfilledTable').empty();
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');
                thead.appendChild(tr);
                $('.fullfilledTable').append(thead);
                let thPName = document.createElement('th');
                thPName.innerHTML = 'Productos';
                tr.appendChild(thPName);
                let thPrice = document.createElement('th');
                thPrice.innerHTML = 'Precio';
                tr.appendChild(thPrice);
                let thIdPrd = document.createElement('th');
                thIdPrd.innerHTML = 'Identificador del producto';
                tr.appendChild(thIdPrd);
                let thCatPrd = document.createElement('th');
                thCatPrd.innerHTML = 'Categoría del producto';
                tr.appendChild(thCatPrd);
                let thStocks = document.createElement('th');
                thStocks.innerHTML = 'Stocks';
                tr.appendChild(thStocks);
                let tbody = document.createElement('tbody');
                $('.fullfilledTable').append(tbody);
                data.productsAll.forEach(function (element) {
                    tr = document.createElement('tr');
                    tbody.appendChild(tr);
                    let tdPName = document.createElement('td');
                    tdPName.innerHTML = element.pname;
                    tr.appendChild(tdPName);
                    let tdPrice = document.createElement('td');
                    tdPrice.innerHTML = element.pprice;
                    tr.appendChild(tdPrice);
                    let tdPPrefix = document.createElement('td');
                    tdPPrefix.innerHTML = element.pprefix;
                    tr.appendChild(tdPPrefix);
                    let tdPrdCategory = document.createElement('td');
                    tdPrdCategory.innerHTML = element.pcategory;
                    tr.appendChild(tdPrdCategory);
                    let tdPrdTotal = document.createElement('td');
                    tdPrdTotal.innerHTML = element.total;
                    tr.appendChild(tdPrdTotal);
                })
                $('.paginationMng').empty();
                let showLefts = document.createElement('p');
                showLefts.innerHTML = "Showing <span class=''>" + (data.offset + 1) + "</span> of <span class=''>" + data.totalPrd + "</span> results";
                $('.paginationMng').append(showLefts);
                let paginates = document.createElement('ul');
                paginates.setAttribute('class', 'text-center');
                if (inputSearch == '') {
                    inputSearch = 0;
                }
                if (data.offset > 0) {
                    paginates.innerHTML += "<li class='d-inline-block pe-auto pages'><div data-offset=" + (data.offset + 10) + "><</div></li>";
                }
                data.pagination.forEach(function (element) {
                    paginates.innerHTML += "<li class='d-inline-block pe-auto pages' style='border-right:1px solid gray;'><div data-offset=" + data.offset + ">" + element.page + "</div></li>";
                })
                if ((data.offset + 10) < data.totalPrd) {
                    paginates.innerHTML += "<li class='d-inline-block pe-auto pages'><div data-offset=" + (data.offset - 10) + ">></div></li>";
                }
                $('.paginationMng').append(paginates);
            }
        })
    })
})