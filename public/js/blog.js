function applyTemplate(tmpl, data) {
    for(var i in data) {
        var tag = '{%' + data[i].name + '%}';
        if(tmpl.indexOf(tag)) {
            tmpl = tmpl.replace(tag, data[i].value);
        }
    }
    return tmpl;
}

var addtriggers     = $('.add-toggle-trigger'),
    addblocks       = $('.toggle-add'),
    addcontent      = $('#new-post-content'),
    addform         = $('#new-post'),
    postLayout      = $('#post-layout').html(),
    postsContainer  = $('#posts-container'),
    postDeleteBtns  = $('.post-delete'),
    postEditBtns    = $('.post-edit');


addcontent.wysihtml5({locale: "ru-RU"});
addtriggers.click(function() {
    addblocks.slideToggle();
});
addform.submit(function(e) {
    e.preventDefault();
    var data = addform.serializeArray();
    console.log(data);
    $.post(this.action, data, function(response) {
        addblocks.fadeToggle();
        postsContainer.prepend(applyTemplate(postLayout, data));
        $('.wysihtml5-sandbox').contents().find('body').html('');
        addform.find('input').val('');
    }, "json");
});
postDeleteBtns.click(function() {
    var id = $(this).parents('.post-wrapper').data('id');
    if(confirm("Вы действительно хотите удалить эту запись?")) {
        $.post('/delpost/' + id, function() {
            location.reload();
        });
    }
});