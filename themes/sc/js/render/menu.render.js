define(['jquery', 'renderTemplate', 'view/view', 'underscore', 'global/url', 'global/message', 'global/constants', 'sortable', 'bootstrap'], function ($, render, view, _, url, message, constant) {
  var $view, controller, el;
  
  function mapElements()
  
  {
    
    el = {
        
      $menuList: $view.find(".js-menu-list"),
      
      $menuItemsContain: $view.find('.js-menu-dragable'),
      
      $saveMenuOrder: $view.find('.js-save-menuOrder'),
      
      $currentMenuId: $view.find('.js-current-menu-id'),
      
      $pageList: $view.find('.js-page-list'),
      
      $pageRecent: $view.find('.js-page-recent'),
      
      $tabPanel: $view.find('.tabs-panel'),
      
      $addMenuBtn: $view.find('.submit-add-to-menu'),
      
      $selectMenuBtn: $view.find('.js-choose-menu'),
      
      $deleteMenuLink: $view.find('.js-delete-menu'),
      
      $menuNameInput: $view.find('.js-menu-name'),
      
      $createMenuBtn: $view.find('.js-create-menu'),
      
      $deleteMenuItem: $view.find('.js-delete-item')
      
    };
    
  }
  
  function bindActions() {
    
    el.$saveMenuOrder.on('click', setMenuOrder);
    
    el.$addMenuBtn.on('click', addPageToMenu);
    
    el.$selectMenuBtn.on('click', selectMenu);
    
    el.$createMenuBtn.on('click', toCreatePage);
    
    el.$menuItemsContain.on('click', '.js-delete-item', deleteMenuItem);
   
  }
  
  function _loadMenuPage() {
    
    controller.getMenusList();
    
  }
  
  function deleteMenuItem() {
    
    var itemId = $(this).attr('data-id');
    
    controller.deleteMenuItem({'itemId': itemId}); 
    
  }
  
  function toCreatePage() {
    
    controller.toCreatePage();
    
  }
  
  function initMenu() {  
    
    el.$menuItemsContain.nestedSortable(
        
      {
        handle: 'dt',
        
        items: 'li',
        
        toleranceElement: '> dl> dt'
          
      });  
   
    var currentMenuId = el.$currentMenuId.val();
    
    controller.initMenuItems({'menuId': currentMenuId});
    
  }
  
  function selectMenu() {
    
    var temMenuId = $('#js-choose-menu-select').val();
    
    controller.selectMenu({menuId: temMenuId});
    
    //controller.select
  }
  
  function setMenuOrder() {
    
    var $orderList=$view.find('.js-menu-items');
    
    var menuList = [];
    
    $orderList.each(function(index, ele) {
      
      var $ele = $(ele);
      
      var parId = $ele.attr('data-parentId');
      
      var newparId = $ele.parent().parent().attr('data-id');
      
      if(newparId === undefined) {
        
        newparId = 0;
        
      }
      
      if (parseInt($ele.attr('data-order')) !== (index + 1) || (parId != newparId)) {
        
        menuList.push({'post_id': $ele.attr('data-id'), 'order': index + 1, 'parent_id': newparId});
      
      }
   
    });
    
    console.log(menuList);
    
    if(menuList.length > 0) {
      
      var params = {menuOrderList: menuList};
      
      controller.resetOrderList(params);
      
    } else {
      
      message.info(constant.ORDER_NOT_CHANGE, false);
      
    }
    
  }
  
  function appendMenuItem(data) { 
    
    var $menuOl=$('<ol></ol>');
    
    _.each(data,function (value, key) {
      
      var output = render.renderTemplate('menuItem', value);
      
      var $menuItem = $(output);
      
      if( value.hasOwnProperty('submenu')) {
        
        var menuTemplate = appendMenuItem(value.submenu);
        
        $menuItem.append(menuTemplate);
        
      }
      
      $menuOl.append($menuItem);
      
    });
    
    return $menuOl;
    
  }
  
  function addPageToMenu() {
    
    var menuItem = [];
    
    var menuId = el.$currentMenuId.val();
    
    _.each(el.$tabPanel,function(value) {
      
      if($(value).css('display') === 'block') {
        
        _.each($(value).find('.page-list').find('li'),function(valueli) {
         
          if($(valueli).find('input[type="checkbox"]').is(':checked')) {
           
           var pageId = $(valueli).attr('data-id');
           
           menuItem.push({'menuId': menuId, 'pageId': pageId});
           
          }
         
        });
        
      }
      
    });
    
    controller.addPageToMenu({menuItems: menuItem});
    
  }
  
  function initPageList() {
    
    controller.viewPageList();
    
  }
  
  function recentPageList() {
    
    controller.recentPageList();
    
  }
  
  return {
    
    init : function (_controller) {
    
      $view = $('.js-edit-menu');
      
      controller = _controller;
      
      mapElements();
      
      bindActions();
      
      _loadMenuPage();
      
      initMenu();
      
      initPageList();
      
      recentPageList();
      
      },
    
    renderMenusList: function(response) {
        
      var output = render.renderTemplate('menuSelect', response);
      
      el.$menuList.html(output);
      
    },
    
    showMenuItem: function(response) {   
      
      el.$menuItemsContain.empty();
      
      _.each(response.data,function(value, key){
        
      var output = render.renderTemplate("menuItem", value);
       
       var $menuItem = $(output);
       
       if(value.hasOwnProperty('submenu')) {
         
         var menuTemplate = appendMenuItem(value.submenu);
         
         $menuItem.append(menuTemplate);
         
       }
       
       el.$menuItemsContain.append($menuItem);
     })
   },
   
    showPageList: function(data) {
     
      if(data) {
        
        el.$pageList.empty();
        
        var output = render.renderTemplate('menuPageList', data);
        
        el.$pageList.html(output);
        
      }
      
    },
    
    recentPageMenu : function(data) {
      
      el.$pageRecent.empty();
      
      var output = render.renderTemplate('menuPageList', data);
      
      el.$pageRecent.html(output);
      
    },
    
    initMenuByAddPage : function(response) {
      
      if(response.status === constant.SUCCESS_STATUS) {
        
          initMenu();
          
          initPageList();
          
          recentPageList();
          
          message.success(constant.ADD_PAGE_SUCCESS,false);
          
      }
      
    },
    
    initSelectMenu: function(response) {
      
      if(response.status === constant.SUCCESS_STATUS) { 
        
          el.$currentMenuId.val(response.data.id);
          
          el.$menuNameInput.val(response.data.name);
          
          var temMenuId = el.$currentMenuId.val();
          
          var URL = url.deleteMenuURL();
          
          URL = URL + '/id/'+temMenuId;
          
          el.$deleteMenuLink.attr('href', URL);
          
          initMenu();
          
      }
      
    },
    
    initDeleteItem: function(response) {
      
      if(response.status === constant.SUCCESS_STATUS) {
        
        initMenu();
        
        message.success(constant.DELETE_ITEM_SUCCESS, false);
        
      }
      
    }
    
  }
  
});
 