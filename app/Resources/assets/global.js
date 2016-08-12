$(document).ajaxSend(function(a, b, c) {
    if (c.type == 'POST') {
        b.setRequestHeader('X-CSRF-Token', $('meta[name=csrf-token]').attr('content'));
    }
});