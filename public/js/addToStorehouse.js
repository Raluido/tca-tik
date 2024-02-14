$(window).on('load', function () {

    let url = document.getElementById('url').value;

    $('#addProductsBtn').on('click', function () {
        let categorySelected = $('#categorySelected').val();
        let inputSearch = $('#searchProductId').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let productSelected = $('#productSelected').val();
        let action = $('#action').val();
        let price = $('#price').val();
        let quantity = $('#quantity').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        });
        $.ajax({
            type: 'post',
            url: '/backoffice/storehousesManagement/addToStorehouse',
            data: {
                'storehouse': storehouseSelected,
                'product': productSelected,
                'action': action,
                'price': price,
                'quantity': quantity
            },
            success: function () {
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
            }
        })
    })

    $('#removeProduct').on('click', function () {
        let categorySelected = $('#filterByCategory').val();
        let storehouseSelected = $('#filterByStorehouse').val();
        let productSelected = $('#productsCounter').val();
        $.ajax({
            type: 'get',
            url: '/storehousesManagement/delete/' + $('#filterByStorehouse').val() + '/' + $('#productsCounter').val(),
            data: {},
            success: function (data) {
                window.location.href = url + '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected;
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
        thPrdId.innerHTML = 'Id';
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