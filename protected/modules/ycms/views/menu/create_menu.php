<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/menu/menuIndex.css';?>" />
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/menu/menubar.css';?>" />
<form action="<?php echo Yii::app()->createUrl('menu/createMenu')?>"  method="post">
  <div class="menu-edit">
    <div class="nav-menu-header">
      <div class="major-publishing-actions clearfix">
        <label class="menu-name-label howto open-label">
          <span>菜单名称</span>
          <input type="hidden" value="2" class="js-current-menu-id">
          <input name="menu-name" type="text" class="menu-item-textbox menu-name js-menu-name" placeholder="在此输入菜单名称" value="">
        </label>
        <div class="publishing-action">
          <input type="submit" name="save_menu" class="button button-primary menu-save" value="Create Menu">
        </div><!-- END .publishing-action -->
      </div>
    </div>
    <div class="post-body">
      <div class="post-body-content">
        <div class="drag-instructions post-body-plain">
          <p>在上面给菜单命名，然后点击“创建菜单”</p>
        </div>
        <div class="js-menu-order">
          <ol class="menu-item-contain js-Menu-dragable ui-sortable"></ol>
        </div>
      </div>
    </div>
    <div class="nav-menu-footer">
      <div class="major-publishing-actions clearfix">
        <div class="publishing-action">
          <input type="submit" name="save_menu" class="button button-primary menu-save " value="Create Menu">
        </div><!-- END .publishing-action -->
      </div>
    </div>
  </div>
</form>