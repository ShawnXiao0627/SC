/**
 * @author Shawn.Xiao
 * @createTime 2013.12.03
 * @version 1.0.1
 */
define(['jquery', 'bootstrap', 'renderTemplate', 'view/view'], function($, bootstrap, render, view) {
  return {
    showConfirmDialog: function(title, msg, callback) {
      var data = {title: title, content: msg};
      var output = render.renderTemplate('confirmDialog', data);
      var $dialog = $(output);

      $dialog.find('.js-confirm-ok').click(callback);
      $dialog.modal('show');
    },
    showErrorDialog: function(msg, time) {
      var data = {title: 'Error', content: msg};
      var output = render.renderTemplate('errorMsgDialog', data);
      var $dialog = $(output);

      $dialog.modal('show');
      setTimeout(function() {
        $dialog.modal('hide');
      }, time);
    }
  }
});