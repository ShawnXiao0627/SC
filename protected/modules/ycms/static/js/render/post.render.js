/**
 *Post render
 */
define(['jquery', 'renderTemplate', 'global/url', 'global/showDialog', 'handleList', 'jqpagination'], function ($, render, URL, dialog) {
  var $view, el, controller;

  function mapElements() {
    el = {
      $posts: $view.find('.js-page-list'),
      $pagination: $view.find('.pagination'),
      $checkedAll: $view.find('.js-check-all')
    };
  }
  
  function bindActions() {
    el.$posts.on('click', '.js-delete-post', _deleteOperate);
    el.$checkedAll.on('click', _selectAllOperate);
    //TODO
    el.$posts.on('mouseover', 'tr', _showAndHide);
    el.$posts.on('mouseout', 'tr', _showAndHide);
  }

  function _showAndHide() {
    $(this).find('.js-record-operate').toggle();
  }

  function _selectAllOperate() {
    var status = el.$posts.find('.js-check-record').prop('checked');
    controller.resetSelectAllStatus(status);
  }

  function _deleteOperate() {
    alert("iipp");
    var id = $(this).data('id');
    dialog.showConfirmDialog('Post Delete', 'Do you want delete this item?', function() {
      controller.deletePost(id);
    });
  }

  function _loadPages(param) {
    controller.showPostList(param);
  }
  
  function pagination() {
    el.$pagination.jqPagination({
      paged: function(page) {
        $view.handleList('option', 'pageNum', page);
      }
    });
  }

  return {
    init: function(_controller) {
      controller = _controller;
      $view = $('.js-page-cms');
      mapElements();
      $view.handleList({updated: _loadPages});
      bindActions();
      pagination();
    },
    renderPostList: function(response) {
        var output = render.renderTemplate('postList', response);
        el.$posts.html(output);
        el.$posts.find('.js-record-operate').hide();
        el.$pagination.jqPagination('option', 'max_page', response.totalPages);
    },
    setSelectAllStatus: function(status) {
        el.$posts.find('.js-check-record').prop('checked', !status);
    },
    showErrorDialog: function(errorMsg) {
      dialog.showErrorDialog(errorMsg, 2000);
    }
  };
});
