define(['render/post.render','model/post.model'], function(render, model) {
  return {
    init: function() {
      render.init(this);
    },
    showPostList: function(conditions) {
      model.getPostList(render.renderPostList, conditions);
    },
    deletePost: function(id) {
      if(id) {
        model.deletePost(render.renderPostList, id);
      } else {
        render.showErrorDialog('Cannot find id!');
      }
    },
    resetSelectAllStatus: function(status) {
      render.setSelectAllStatus(status);
    }
  };
});
