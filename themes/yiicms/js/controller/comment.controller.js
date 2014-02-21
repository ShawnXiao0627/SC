/**
 * @author Denny.chen
 * @createTime 2013.12.03
 * @version 1.0.1
 */
define(['render/comment.render', 'model/comment.model', 'global/constants'], function(render, model, constant) {

  function _dealCommentList(response) {
    var status, initialStatus, commentList;

    initialStatus = response.statusCountList;
    commentList = response.commentList;
    for (var n in commentList) {
      status = commentList[n]['comment_approved'];
      if (status === constant.COMMENT_DBSTATUS_REJECT || status === constant.COMMENT_DBSTATUS_NEW) {
        commentList[n]['comment_approved'] = constant.COMMENT_STATUS_APPROVE;
      } else if (status === constant.COMMENT_DBSTATUS_APPROVE) {
        commentList[n]['comment_approved'] = constant.COMMENT_STATUS_REJECT;
      }
    }
    render.renderCommentList(commentList, initialStatus);
  }
  
  return {
    init: function() {
        render.init(this);
    },

    getCommentList: function() {
      model.getCommentList(function(response) {
        _dealCommentList(response);
      });
    },
    
    operateComment: function(commentId, commentStatus, $obj) {
      var params = {
          'commentId': commentId,
          'commentStatus': commentStatus
      };
      model.operateComment(function(response) {
        render.renderOperation(response, $obj);
      }, params);
    },

    getStatusList: function(categoryStatus) {
      if (categoryStatus === constant.COMMETN_STATUS_ALL) {
        model.getCommentList(function(response) {
          _dealCommentList(response);
        });
      } else {
        model.getStatusList(render.renderStatusList, categoryStatus);
      }
    }

  }
});