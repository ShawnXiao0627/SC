/**
 * Post form Model
 */
define(['jquery','global/url'], function($, URL) {

  
  return {
    loadInitData: function(callback) {
      $.ajax({
        type: 'get',
        url: URL.loadInitDataURL(),
        dataType:'json',
        success: function(response){
          callback(response);
        },
        error: function(){
        }
      });
    }
  }
});
