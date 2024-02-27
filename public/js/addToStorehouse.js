$(window).on('load', function () {

    let url = document.getElementById('url').value;

    $('body').on('click', 'button#addProductsBtn', function () {
        let categorySelected = $('#categorySelected').val();
        let inputSearch = $('#searchProductId').val();
        let storehouseSelected = $('#storehouseSelected').val();
        let productSelected = $('#productSelected').val();
        let historic = $('#historicSelected').val();
        let offset = $('#offset').val();
        let action = $('#action').val();
        let price = $('#price').val();
        let quantity = $('#quantity').val();
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        });
        $.ajax({
            type: 'post',
            url: url + '/backoffice/storehousesManagement/addToStorehouse',
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
                    url: url + '/backoffice/storehousesManagement/showProductsAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset + '/' + historic,
                    data: {},
                    success: function (data) {
                        fullFilledTable(data, historic);
                        $('#storehouseSelected').val(storehouseSelected);
                        $('#offset').val(0);
                    }
                })
            }
        })
    })

    $('body').on('click', 'button#removeProduct', function () {
        if (confirm("Vas a eliminar un movimiento del stock\nEstás seguro?") == true) {
            let categorySelected = $('#categorySelected').val();
            let storehouseSelected = $('#storehouseSelected').val();
            let inputSearch = $('#searchProductId').val();
            let historic = $('#historicSelected').val();
            let offset = $('#offset').val();
            $.ajax({
                type: 'get',
                url: url + '/backoffice/storehousesManagement/delete/' + $(this).attr('data-id'),
                data: {},
                success: function () {
                    $.ajax({
                        type: 'GET',
                        url: url + '/backoffice/storehousesManagement/showProductsAjax/' + storehouseSelected + '/' + categorySelected + '/' + inputSearch + '/' + offset + '/' + historic,
                        data: {},
                        success: function (data) {
                            fullFilledTable(data, historic);
                            $('#storehouseSelected').val(storehouseSelected);
                            $('#offset').val(0);
                        }
                    })
                }
            })
        }
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
        let thqtt = document.createElement('th');
        thqtt.innerHTML = 'Cantidad';
        tr.appendChild(thqtt);
        let thstc = document.createElement('th');
        thstc.innerHTML = 'Stock';
        tr.appendChild(thstc);
        let thUpdated = document.createElement('th');
        thUpdated.innerHTML = 'Fecha';
        tr.appendChild(thUpdated);
        let thDel = document.createElement('th');
        thDel.innerHTML = 'Borrar';
        tr.appendChild(thDel);

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
            let tdQtt = document.createElement('td');
            tdQtt.innerHTML = element.quantity;
            tr.appendChild(tdQtt);
            let tdStc = document.createElement('td');
            tdStc.innerHTML = element.stock;
            tr.appendChild(tdStc);
            let tdUpdated = document.createElement('td');
            tdUpdated.innerHTML = element.updated_at;
            tr.appendChild(tdUpdated);
            if (element.stock > 0 && element.quantity > 0) {
                let tdDel = document.createElement('td');
                tdDel.innerHTML = "<button class='btn btn-danger btn-sm' id='removeProduct' data-id=" + element.id + ">Borrar</button>";
                tr.appendChild(tdDel);
            }
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
})