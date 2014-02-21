define(['jquery', 'global/url', 'global/message', 'global/constants'], function ($, url, message, constant){
  return {
    
    getMenusList: function (callback) {
    
      $.ajax({
        
        type: 'POST',
        
        url: url.getMenusListURL(),
        
        dataType: 'JSON',
        
        success: function(response) {
        
          if (typeof callback === 'function') {
            
            callback(response);
            
          }
          
        }
      
      });
      
    },
    
    showMenuItem: function (callback, params) {
      
      $.ajax({
        
        type: 'POST',
        
        url: url.showMenuURL(),
        
        dataType: 'JSON',
        
        data: params,
        
        success: function(response) {
        
          if(_.isFunction(callback)) {
            
            callback(response);
            
          }
          
        }
      
      });
      
    },
    
    resetOrderList: function (parmas) {
      
      $.ajax({
        
        type: 'POST',
        
        url: url.resetMenuURL(),
        
        data:parmas,
        
        dataType: 'JSON',
        
        success: function(response) {
        
          message.success(constant.RESET_MENUSTATUS_SUCCESS, false);
          
        }
      
      });
      
    },
    
    shwoPageList: function (callback) { 
      
      $.ajax({
        
        type: 'POST',
        
        url: url.getPageListOfMenu(),
        
        dataType: 'JSON',
        
        success: function(response) {
        
          if(response.status === constant.SUCCESS_STATUS && response.count > 0){
            
            if(_.isFunction(callback)) {
              
              callback(response);
              
            }
            
          }
          
        }
      
      });
      
    },
    
    recentPageList: function (callback) {
      
      $.ajax({
        
        type: 'POST',
        
        url: url.getRecentPageList(),
        
        dataType: 'JSON',
        
        success: function(response) {
        
          if(response.status === constant.SUCCESS_STATUS && response.count > 0){
            
            if(_.isFunction(callback)) {
              
              callback(response);
              
            }
            
          }
          
        }
      
      });
      
    },
    
    addPageToMenu: function (callback, parmas) { 
      
      $.ajax({
        
        type: 'POST',
        
        url: url.addPageToMenu(),
        
        dataType: 'JSON',
        
        data: parmas,
        
        success: function(response) {
        
          callback(response);
          
        }
      
      });
      
    },
    
    selectMenu: function (callback, parmas) {
      
      $.ajax({
        
        type: 'POST',
        
        url: url.selectMenuURL(),
        
        dataType: 'JSON',
        
        data: parmas,
        
        success: function(response) {
        
          callback(response);
          
        }
      
      });
      
    },
    
    toCreatePage: function() {
      
      window.location.href = url.createMenuPageURL();
      
    },
    
    deleteMenuItem: function(callback, params) {
      
      $.post(url.deleteItemURL(), params, function(response) {
        
        if(_.isFunction(callback)) {
          
          callback(response);
          
        }
        
      }, 'JSON')
      
    }
    
  }
  
});

