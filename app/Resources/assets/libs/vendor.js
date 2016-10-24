import './vendor.less';

import 'jquery';
import 'bootstrap';
import 'bootstrap-notify';

$(document).ajaxSend(function(a, b, c) {
  if (c.type == 'POST') {
    b.setRequestHeader('X-CSRF-Token', $('meta[name=csrf-token]').attr('content'));
  }
});

$('#modal').on('show.bs.modal', function (e) {
  $(this).load($(e.relatedTarget).data('url'));
})
