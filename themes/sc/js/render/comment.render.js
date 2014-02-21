/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
define(['jquery', 'renderTemplate', 'view/view', 'underscore', 'global/constants'], function($, render, view, _, constant) {
  var $view, controller, el;

  function _loadCommentList() {
    controller.getCommentList();
  }

  function _operateComment() {
    var $obj = $(this);
    var commentStatus = $obj.attr('data-status');
    var commentId = $obj.parent().attr('data-id');
    controller.operateComment(commentId, commentStatus, $obj);
  }

  function _getCommentStatusList() {
    var $obj = $(this);
    var categoryStatus = $obj.attr('data-content');
    controller.getStatusList(categoryStatus);
  }

  function _changeCommentStatusCount(status) {
    el.$commentStatusCount.find('.js-comment-count-pending').html(status.pending_count);
    el.$commentStatusCount.find('.js-comment-count-spam').html(status.spam_count);
    el.$commentStatusCount.find('.js-comment-count-recyclebin').html(status.trash_count);
  }
  
  function _resetCommentTagContent($obj, status) {
    $obj.text(status);
    $obj.attr("data-status", status);
  }

  function _showCommentOperation()
  {
    $(this).find('.js-comment-showOperate').show();
  }
  
  function _hideCommentOperation()
  {
    $(this).find('.js-comment-showOperate').hide();
  }
  

  function mapElements() {
    el = {
        $commentList: $view.find('.js-comment-list'),
        $commentStatusCount: $view.find('.js-comment-count-status')
    };
  }

  function bindActions() {
    el.$commentList.on('mouseover', '.js-comment-record', _showCommentOperation);
    el.$commentList.mouseout('.js-comment-record', _hideCommentOperation);
    el.$commentList.on('click', '.js-comment-operation', _operateComment);
    //el.$commentList.delegate('.js-comment-operation', 'click', _operateComment);
    el.$commentStatusCount.on('click', '.js-comment-status-list', _getCommentStatusList);
  }

  return{
    init: function(_controller) {
      $view = $('.js-comment-cms');
      controller = _controller;
      mapElements();
      bindActions();
      _loadCommentList();
    },

    renderCommentList: function(commentList, initialStatus) {
      _changeCommentStatusCount(initialStatus);
      var output = render.renderTemplate('commentList', commentList);
      el.$commentList.html(output);
    },

    renderStatusList: function(data) {
      var output = render.renderTemplate('commentList', data.statusList);
      el.$commentList.html(output);
    },

    renderOperation: function(data, $obj) {
      var status = data.status;
      var afterOperateStatus = data.statusCountList;

      if (status === constant.COMMENT_DBSTATUS_APPROVE) {
        _changeCommentStatusCount(afterOperateStatus);
        _resetCommentTagContent($obj, constant.COMMENT_STATUS_REJECT);
      } else if (status === constant.COMMENT_DBSTATUS_REJECT) {
        _changeCommentStatusCount(afterOperateStatus);
        _resetCommentTagContent($obj, constant.COMMENT_STATUS_APPROVE);
      } else if (status === constant.COMMENT_DBSTATUS_SPAM) {
        _changeCommentStatusCount(afterOperateStatus);
      } else if (status === constant.COMMENT_DBSTATUS_TRASH) {
        _changeCommentStatusCount(afterOperateStatus);
      }
    }
  }

});