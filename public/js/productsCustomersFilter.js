$(window).on('load', function () {
    let url = document.getElementById('url').value;
    $.ajax({
        url: url + '/filterAjax',
        type: "GET",
        data: {},
        success: function (data) {
            fullFilledTable(data);
        }
    })

    $('#filterByCat').on('change', function () {
        let offset = $('#offsetSelected').val();
        $.ajax({
            url: url + '/filterAjax/' + $(this).val() + offset,
            type: "GET",
            data: {},
            success: function (data) {
                fullFilledTable(data);
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
        card.innerHTML += "<h4 class=''>" + element.pname + "</h4><p class=''>" + element.pdescription + "</p><h5 class=''>" + element.pprice + "€</h5>";
    })
}