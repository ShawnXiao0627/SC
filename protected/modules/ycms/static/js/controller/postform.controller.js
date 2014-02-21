define(['render/postform.render', 'model/postform.model'], function(render, model) {
  return {
      init: function() {
        render.init(this);
      },
      loadInitData: function() {
        model.loadInitData(render.renderInitData);
      }
    };
});
