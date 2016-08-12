var $form = $("#example-form");
$form.submit(function(e) {
    e.preventDefault();
    $.post($form.attr('action'), $form.serialize(), function(response) {
        $('#result').html(JSON.stringify(response));
    });
});

var $btn = $("#hello-btn");
$btn.on('click', function() {
    $.post($btn.data('url'), function(){
        alert('hello!');
    });
});