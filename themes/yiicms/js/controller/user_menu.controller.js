define(['model/user_menu.model','render/user_menu.render'],function(model,render){
  return {
    init : function(){
      render.init(this);
    } ,
    initUserMenu: function ()
    {
      model.initUserMenu(render.showMenuItem);
    }
  }
});