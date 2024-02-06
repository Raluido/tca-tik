$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $('#filterByStorehouse').on('change', function (e) {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#filterByCategory').val();
        let productSelected = document.getElementById('productSelectedId').value;
        let inputSearch = $('#inputSearch').val();
        if (inputSearch == '') {
            inputSearch = 0;
        }
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/storehousesManagement/showall');
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected + '/' + inputSearch,
            data: {},
            success: function (data) {
                $('.table').empty();
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');
                thead.appendChild(tr);
                $('.table').append(thead);
                let thName = document.createElement('th');
                thName.innerHTML = 'Nombre';
                tr.appendChild(thName);
                let thPrefix = document.createElement('th');
                thPrefix.innerHTML = 'Prefijo';
                tr.appendChild(thPrefix);
                let thDcrp = document.createElement('th');
                thDcrp.innerHTML = 'Descripción';
                tr.appendChild(thDcrp);
                let thPrd = document.createElement('th');
                thPrd.innerHTML = 'Productos';
                tr.appendChild(thPrd);
                let thPrice = document.createElement('th');
                thPrice.innerHTML = 'Precio';
                tr.appendChild(thPrice);
                let thPrdId = document.createElement('th');
                thPrdId.innerHTML = 'Identificador del producto';
                tr.appendChild(thPrdId);
                let thPrdCat = document.createElement('th');
                thPrdCat.innerHTML = 'Categoría del producto';
                tr.appendChild(thPrdCat);
                let thtotal = document.createElement('th');
                thtotal.innerHTML = 'Total';
                tr.appendChild(thtotal);
                let tbody = document.createElement('tbody');
                $('.table').append(tbody);
                data.filtered.forEach(function (element) {
                    tr = document.createElement('tr');
                    tbody.appendChild(tr);
                    let tdName = document.createElement('td');
                    tdName.innerHTML = element.name;
                    tr.appendChild(tdName);
                    let tdPrefix = document.createElement('td');
                    tdPrefix.innerHTML = element.prefix;
                    tr.appendChild(tdPrefix);
                    let tdDscrp = document.createElement('td');
                    tdDscrp.innerHTML = element.description;
                    tr.appendChild(tdDscrp);
                    let tdPrdName = document.createElement('td');
                    tdPrdName.innerHTML = element.pname;
                    tr.appendChild(tdPrdName);
                    let tdPrdPrice = document.createElement('td');
                    tdPrdPrice.innerHTML = element.pprice;
                    tr.appendChild(tdPrdPrice);
                    let tdPrdPrefix = document.createElement('td');
                    tdPrdPrefix.innerHTML = element.pprefix;
                    tr.appendChild(tdPrdPrefix);
                    let tdPrdCat = document.createElement('td');
                    tdPrdCat.innerHTML = element.pcategory;
                    tr.appendChild(tdPrdCat);
                    let tdTotal = document.createElement('td');
                    tdTotal.innerHTML = element.total;
                    tr.appendChild(tdTotal);
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

    $('#filterByCategory').on('change', function () {
        let storehouseSelected = $('#filterByStorehouse').val();
        let categorySelected = $('#filterByCategory').val();
        let productSelected = document.getElementById('productSelectedId').value;
        let inputSearch = $('#inputSearch').val();
        if (storehouseSelected == 0 && categorySelected == 0) {
            window.location.assign(url + '/storehousesManagement/showall');
            return;
        }
        $.ajax({
            type: 'GET',
            url: '/storehousesManagement/showBy/' + storehouseSelected + '/' + categorySelected + '/' + productSelected + '/' + inputSearch,
            data: {},
            success: function (data) {
                $('.table').empty();
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');
                thead.appendChild(tr);
                $('.table').append(thead);
                let thName = document.createElement('th');
                thName.innerHTML = 'Nombre';
                tr.appendChild(thName);
                let thPrefix = document.createElement('th');
                thPrefix.innerHTML = 'Prefijo';
                tr.appendChild(thPrefix);
                let thDcrp = document.createElement('th');
                thDcrp.innerHTML = 'Descripción';
                tr.appendChild(thDcrp);
                let thPrd = document.createElement('th');
                thPrd.innerHTML = 'Productos';
                tr.appendChild(thPrd);
                let thPrice = document.createElement('th');
                thPrice.innerHTML = 'Precio';
                tr.appendChild(thPrice);
                let thPrdId = document.createElement('th');
                thPrdId.innerHTML = 'Identificador del producto';
                tr.appendChild(thPrdId);
                let thPrdCat = document.createElement('th');
                thPrdCat.innerHTML = 'Categoría del producto';
                tr.appendChild(thPrdCat);
                let thtotal = document.createElement('th');
                thtotal.innerHTML = 'Total';
                tr.appendChild(thtotal);
                let tbody = document.createElement('tbody');
                $('.table').append(tbody);
                data.filtered.forEach(function (element) {
                    tr = document.createElement('tr');
                    tbody.appendChild(tr);
                    let tdName = document.createElement('td');
                    tdName.innerHTML = element.name;
                    tr.appendChild(tdName);
                    let tdPrefix = document.createElement('td');
                    tdPrefix.innerHTML = element.prefix;
                    tr.appendChild(tdPrefix);
                    let tdDscrp = document.createElement('td');
                    tdDscrp.innerHTML = element.description;
                    tr.appendChild(tdDscrp);
                    let tdPrdName = document.createElement('td');
                    tdPrdName.innerHTML = element.pname;
                    tr.appendChild(tdPrdName);
                    let tdPrdPrice = document.createElement('td');
                    tdPrdPrice.innerHTML = element.pprice;
                    tr.appendChild(tdPrdPrice);
                    let tdPrdPrefix = document.createElement('td');
                    tdPrdPrefix.innerHTML = element.pprefix;
                    tr.appendChild(tdPrdPrefix);
                    let tdPrdCat = document.createElement('td');
                    tdPrdCat.innerHTML = element.pcategory;
                    tr.appendChild(tdPrdCat);
                    let tdTotal = document.createElement('td');
                    tdTotal.innerHTML = element.total;
                    tr.appendChild(tdTotal);


                })
            }
        })
    })
})