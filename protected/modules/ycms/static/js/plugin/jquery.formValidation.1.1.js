(function($) {
  var $this;
  $.fn.validateElement = function(options) {
    var emptyMessage = gd.util.t('not_null'), lengthMessage = gd.util.t('length_error'), regxMessage = gd.util.t('regx_error');
    var errorMessage = $.extend({
      option1: regxMessage,
      option2: lengthMessage,
      option3: emptyMessage
    }, options || {});
    var text = $.trim(this.val());
    var length = text.length;
    $this = this;
    var name = this.attr('name');
    var rexStr = /\[|\]/g;
    name=name.replace(rexStr, '');
    var message = $('.' + name + 'Error');
    message.html('&nbsp;')
    if(length <= 0) {
      message.html(emptyMessage);
      return false;
    }
    if(validateAttr('minLength') || validateAttr('maxLength')) {
      var minLength = this.attr('minLength') || 0;
      var maxLength = this.attr('maxLength') || 255;
      if(length < parseInt(minLength) || length > parseInt(maxLength)) {
        message.html(lengthMessage);
        return  false;
      }
    }
    if(validateAttr('regx')) {
      var reg = this.attr('regx');
      var regx = new RegExp(reg);
      if(!regx.test(text)) {
        message.html(regxMessage);
        return false;
      }
    }
    return true;
  }
  
  function validateAttr(attributes) {
    return (!('undefined' === typeof($this.attr(attributes))));
  }
})(jQuery);