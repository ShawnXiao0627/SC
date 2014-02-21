define(['render/menu.render', 'model/menu.model'], function (render, model){
  function _getMenusList() {
    model.getMenusList(render.renderMenusList);
  }
  
  return {
    init: function () { 
      render.init(this);
    },
    
    getMenusList: function () {
      return _getMenusList();
    },
    
    initMenuItems: function (parmas) {
      model.showMenuItem(render.showMenuItem, parmas);
    },
    
    resetOrderList: function (params) {
      model.resetOrderList(params);
    },
    
    viewPageList: function () {
      model.shwoPageList(render.showPageList);
    },
    
    recentPageList: function () {
      model.recentPageList(render.recentPageMenu);
    },
    
    addPageToMenu: function (params) {
      model.addPageToMenu(render.initMenuByAddPage, params);
    },
    
    selectMenu: function (params) {
      model.selectMenu(render.initSelectMenu, params)
    },
    
    toCreatePage: function () {
      model.toCreatePage();
    },
    
    deleteMenuItem: function (params) {
      model.deleteMenuItem(render.initDeleteItem, params)
    }
  }
});
