/**
 * @author Denny.Chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
define(function(){

  var cmsMode = 'dev';

  var modes = {
    prod: {
      'menuList':'/menu/list',
      'deleteMenu':'/menu/delete'
    },
    dev: {
      //Menu URLs
      'menuList':'/menu/list',
      'deleteMenu':'/menu/delete',
      'showMenuItems':'/menu/showMenu',
      'resetMenuOrder':'/menu/resetMenuOrder',
      'getMenuById':'/menu/getMenu',
      'addPageToMenu' : '/menu/addPageToMenu',
      'menuOfPageList':'/post/getAllPage',
      'selectMenu' : '/menu/selectMenu',
      'deleteItem': '/menu/deleteItem',
      'toCreateMenu': '/menu/toCreate',
      'showUserMenuItems': '/menu/showUserMenu',
      //Post URLs
      'PageList':'/post/adminList',
      'deletePost':'/post/delete',
      'recentPageList':'/post/getNewPage',
      'loadInitFormData' : '/post/loadInitFormData',
      //Comment URLs
      'commentList': '/comment/list',
      'operateComment': '/comment/operate',
      'statusList': '/comment/statusList',
      'markAsSpam': '/comment/markSpam'

    }
  };
  
  var _modeName = cmsMode || 'dev';
  var _mode = modes[_modeName];

  /**
   * Generate access url.
   * 
   * @param mode the key of the accessed url defined in modes object.
   */
  function _genAccessURL(mode) {
    return baseHomeUrl + _mode[mode];
  }
  
  return {
    //Generate Menu URLs
    getMenusListURL: function() {
      return _genAccessURL('menuList');
    },
    getMenuByIdURL: function() {
      return _genAccessURL('getMenuById');
    },
    deleteMenuURL: function() {
      return _genAccessURL('deleteMenu');
    },
    selectMenuURL: function() {
      return _genAccessURL('selectMenu');
    },
    showUserMenuItem:function() {
      return _genAccessURL('showUserMenuItems');
    },
    deleteItemURL: function() {
      return _genAccessURL('deleteItem');
    },
    showMenuURL: function () {
      return _genAccessURL('showMenuItems');
    },
    createMenuPageURL: function () {
      return _genAccessURL('toCreateMenu');
    },
    resetMenuURL: function () {
      return _genAccessURL('resetMenuOrder');
    },
    
    //Generate page/post URLs
    getPageListOfMenu: function () {
      return _genAccessURL('menuOfPageList');
    },
    getRecentPageList: function () {
      return _genAccessURL('recentPageList');
    },
    getPostListURL: function() {
      return _genAccessURL('PageList');
    },
    addPageToMenu: function () {
      return _genAccessURL('addPageToMenu');
    },
    getDeletePostURL: function() {
      return _genAccessURL('deletePost');
    },
    loadInitDataURL: function () {
      return _genAccessURL('loadInitFormData');
    },
    
    //Generate comment URLs
    getCommentListURL: function() {
      return _genAccessURL('commentList');
    },
    getOperateCommentURL: function() {
      return _genAccessURL('operateComment');
    },
    getStatusListURL: function() {
      return _genAccessURL('statusList');
    },
    markAsSpamURL: function() {
      return _genAccessURL('markAsSpam');
    }

  }
});