define(['jquery', 'view/view', 'renderTemplate', 'underscore', 'global/constants'], function($, view, template, _, constant) {
  var el, controller, $view;
  function initUserMenu() {
    controller.initUserMenu();
  }
  function mapElements() {
    el = {
        $menuItems: $view.find('.js-nav-menu-items')
    };
  }
  
  function appendMenuItem(data) { 
    var $menuUl=$('<ul></ul>');
    _.each(data,function (value, key){
    var output = template.renderTemplate('userMenuItem', value);
    var $menuItem = $(output);
    if( value.hasOwnProperty('submenu')) {
      var menuTemplate = appendMenuItem(value.submenu);
      $menuItem.append(menuTemplate);
    }
    $menuUl.append($menuItem);
    });
    return $menuUl;
  }
  return {
    init: function(_controller){
      $view = $('.js-menu-nav');
      controller = _controller;
      mapElements();
      initUserMenu();
    },
    showMenuItem: function(response)
    {
      if(response.status === constant.SUCCESS_STATUS){
        el.$menuItems.empty();
        var menuTemplate = appendMenuItem(response.data);
        el.$menuItems.html(menuTemplate);
      } 
      
    }
  }
});