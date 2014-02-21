/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
define(['jquery', 'global/url'], function($, url) {
  return {
    getCommentList: function(callback) {
      $.getJSON(url.getCommentListURL(), function(response) {
        if (_.isFunction(callback)) {
          callback(response);
        }
      });
    },

    operateComment: function(callback, params) {
      $.ajax({
        type: 'POST',
        url: url.getOperateCommentURL(),
        data: params,
        dataType: 'JSON',
        success: function(response) {
          if(typeof callback === 'function') {
            callback(response);
          }
        }
      });
    },

    getStatusList: function(callback, categoryStatus) {
      var urls = url.getStatusListURL() + '?categoryStatus=' + categoryStatus;
      $.getJSON(urls, function(response) {
        if (_.isFunction(callback)) {
          callback(response);
        }
      });
    }

  }
});