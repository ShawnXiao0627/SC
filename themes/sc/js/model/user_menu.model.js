define(['jquery', 'global/url'], function($, url){
  return {
    initUserMenu: function(callback) {
      $.ajax({
        type: 'POST',
        url: url.showUserMenuItem(),
        dataType: 'JSON',
        success: function (response) { 
          if (typeof callback === 'function')
          { 
            callback(response);
          }
        }
      });
    }
  }
});