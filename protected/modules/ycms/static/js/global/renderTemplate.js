/**
 * @author Boris.Huai
 * @createTime 2013.10.16
 * @version 1.0.1
 */
define(['lib/mustache', 'view/view'], function(m, view) {
  return {
    renderTemplate: function(templateName, obj) {
    // the obj must be {} or [{},{},{}...]
      if (obj && (typeof(obj) != 'object')) {
        return;
      } else {
        if (Object.prototype.toString.call(obj) === '[object Array]'){
          data = {"data": obj};
        } else {
          data = obj;
        }
        if (templateName && view[templateName]) {
          return m.to_html(view[templateName], data||{});
        }
      }
    }
  }
});