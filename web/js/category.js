function getLiElement(category) {
    return '<li  class="list-unstyled">' +
            '<h2>' + category.name + '</h2>' +
            '<form class="category-form">' +
                '<input type="hidden" name="parent_id" value="' + category.id + '">' +
                '<div class="form-group">' +
                    '<input class="form-control" type="text" name="name" placeholder="Введите имя дочерней категории" required>' +
                '</div>' +
                '<div class="form-group">' +
                    '<button class="btn btn-success">+</button>' +
                '</div>' +
            '</form>' +
            '<button class="btn btn-default show-subcategory" data-id="' + category.id + '">Показать дочерние</button>' +
            '<ul class="ul-' + category.id + '"></ul>'+
        '</li>';
}

function addNewCategory(response) {
    let category = response;
    let parentId = +category.parent_id;
    let ul = $('.ul-' + parentId);
    ul.append(getLiElement(category));
    ul.show();
    let btn = $('.show-subcategory[data-id=' + category.parent_id + ']');
    btn.text('Скрыть дочерние');
    btn.removeClass('show-subcategory');
    btn.addClass('hide-subcategory');
}

function showSubcategories(response) {
    let subcategories = response.subcategories;
    let ul = $('.ul-' + response.id);
    let subCategoriesAppendString = '';
    ul.text('');

    subcategories.forEach(function(item, index, array) {
        subCategoriesAppendString += getLiElement(item);
    });
    ul.append(subCategoriesAppendString);
    ul.show();
}

$('.main-container').on('submit', '.category-form', function (e) {
    e.preventDefault();
    let self = $(this);
    $.post('/api/v1/category', self.serialize())
        .done(addNewCategory)
        .fail(function (response) {
            console.error(response);
        });
    return false;
}).on('click', '.show-subcategory', function (e) {
    let self = $(this);
    let id = self.data('id');
    $.get('/api/v1/category/' + id, self.serialize())
        .done(showSubcategories)
        .fail(function (response) {
            console.error(response);
        });
    self.removeClass('show-subcategory');
    self.addClass('hide-subcategory');
    self.text('Скрыть дочение');
}).on('click', '.hide-subcategory', function (e) {
    let self = $(this);
    let id = self.data('id');
    let ul = $('.ul-' + id);
    ul.hide();
    self.removeClass('hide-subcategory');
    self.addClass('show-subcategory');
    self.text('Показать дочение');
});
