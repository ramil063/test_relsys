function getLiElement(category) {
    return '<li>' +
            '<h2>' + category.name + '</h2>' +
            '<form class="category-form">' +
                '<input type="hidden" name="parent_id" value="' + category.id + '">' +
                '<label for="name">' +
                    'Добавить дочерний' +
                    '<input type="text" name="name">' +
                '</label>' +
                '<button class="btn btn-success">+</button>' +
            '</form>' +
            '<button class="btn btn-default show-subcategory" data-id="' + category.id + '">v</button>' +
            '<ul class="ul-' + category.id + '"></ul>'+
        '</li>';
}

function addNewCategory(response) {
    let category = response;
    let parentId = +category.parent_id;
    let ul = $('.ul-' + parentId);
    ul.append(getLiElement(category));
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
});
