/**
 * Post Model
 */
define(['jquery','global/url'], function($, URL) {

  function _getList(url, callback) {
    $.getJSON(url, function(response) {
      callback(response);
    });
  }
  
  return {
    getPostList: function(callback, conditions) {
      var url = '';
      if('' === conditions) {
        url = URL.getPostListURL();
      } else {
        url = URL.getPostListURL() + '?' + conditions;
      }
      _getList(url, callback);
    },
    deletePost: function(callback, id) {
      var urlDelete = URL.getDeletePostURL();
      var urlList = URL.getPostListURL();
      var param = {'id': id};
      
      $.ajax({
        type: 'post',
        url: urlDelete,
        data: param,
        dataType: 'json',
        success: function(response) {
          if(response.status === 'success') {
            _getList(urlList, callback);
          }
        }
      });
    }
  }
});
