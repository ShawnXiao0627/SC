<script src="<?php echo $this->module->assetsUrl; ?>/js/lib/require.js"  data-main="<?php echo Yii::app()->theme->baseUrl; ?>/js/index.js" data-start="controller/menu.controller"></script>
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/menu/menuIndex.css';?>" />
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/menu/menubar.css';?>" />
<ul class="nav nav-tabs">
  <li><a href="#EditMenu" data-toggle="tab">Edit Menu</a></li>
  <li><a href="#ManagePosition" data-toggle="tab">Manage position</a></li>
</ul>
<div id="alert_message" class="alert fade in hide alert_message">
  <button class="close" type="button">×</button>
  <span></span>
</div>
<div class="tab-content">
  <div class="tab-pane active js-edit-menu" id="editMenu">
    <div class="manage-menus js-menu-cms">
      <label for="menu" class="select-menu">Choose menu to edit:</label>
      <div class="js-menu-list">
      </div>
      <div id="js-menu-operation" class="tab-pane__btn-group">
        <span class="submit-btn">
          <button class="btn btn-default btn-xs js-choose-menu">Choose</button>
        </span>
        <span class="submit-btn">
          <button class="btn btn-danger btn-xs js-create-menu">Create Menu</button>
        </span>
        <span class="submit-btn">
          <a class =" btn btn-default btn-xs" href=<?php echo Yii::app()->createUrl('menu/test');?>>view</a>
        </span>
      </div>
    </div>
    <div id="MenuStructure">
      <div class="nav-menus-frame clearfix">
        <div class="metabox-holder" id="accordion-add-list">
          <ul class="outborder">
            <li class="l-control-section add-page">
              <h3 class="control-section-title page-title" data-toggle="collapse" data-target="#tab-page_content" data-parent="#accordion-add-list">页面</h3>
              <div class="control-section-content collapse in" id="tab-page_content">
                <div class="inside">
                  <ul class="add-menu-items-tabs ">
                    <li class=""><a href="#recently-page" data-toggle="tab">最近</a></li>
                    <li><a href="#all-page" data-toggle="tab">查看所有</a></li>
                    <li><a href="#search-page" data-toggle="tab">搜索</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tabs-panel tab-pane active" id="recently-page" >
                      <ul class="page-list js-page-recent">
                        
                      </ul>
                    </div>
                    <div class="tabs-panel tab-pane" id="all-page">
                      <ul class="page-list js-page-list">
                        
                      </ul>
                    </div>
                    <div class="tabs-panel tab-pane" id="search-page">
                      <p class="quick-search-wrap">
                        <input type="search" class="quick-search" title="搜索" value="" placeholder="搜索">
                      </p>
                    </div>
                    <p class="button-controls clearfix">
                      <span class="list-controls">
                        <a href="" class="select-all">全选</a>
                      </span>
                      <span class="add-to-menu">
                        <input type="button" class="button-secondary submit-add-to-menu " value="添加至菜单" name="add-post-type-menu-item" >
                        <span class="spinner"></span>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </li>
            <li class="l-control-section add-link">
              <h3 class="control-section-title page-title" data-toggle="collapse" data-target="#tab-link-content" data-parent="#accordion-add-list">链接</h3>
              <div class="control-section-content collapse" id="tab-link-content">
                <div class="inside">
                  <div class="add-link-menu">
                    <p class="menu-item-url-wrap ">
                      <label class="howto clearfix" >
                        <span>URL</span>
                        <input  type="text" class="menu-item-textbox" value="http://">
                      </label>
                    </p>
                    <p class="menu-item-name-wrap ">
                      <label class="howto clearfix" >
                        <span>链接文字</span>
                        <input  type="text" class=" menu-item-textbox" title="菜单项目">
                      </label>
                    </p>
                  </div>
                  <p class="button-controls clearfix">
                      <span class="add-to-menu">
                        <input type="submit" class="button-secondary submit-add-to-link " value="添加至菜单" name="add-post-type-menu-item" >
                        <span class="spinner"></span>
                      </span>
                    </p>
                </div>
              </div>
            </li>
            <li class="l-control-section add-class">
              <h3 class="control-section-title page-title" data-toggle="collapse" data-target="#tab-class-content" data-parent="#accordion-add-list">分类</h3>
              <div class="control-section-content collapse" id="tab-class-content">
                <div class="inside">
                  <ul class="add-menu-items-tabs ">
                    <li class=""><a href="#recently-class" data-toggle="tab">最常用</a></li>
                    <li><a href="#all-class" data-toggle="tab">查看所有</a></li>
                    <li><a href="#search-class" data-toggle="tab">搜索</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tabs-panel tab-pane active" id="recently-class" >
                      <ul class="page-list">
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                      </ul>
                    </div>
                    <div class="tabs-panel tab-pane" id="all-class">
                      <ul class="page-list">
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                        <li>
                          <label class="menu-item-title">
                            <input type="checkbox"/>页面2
                          </label>
                        </li>
                      </ul>
                    </div>
                    <div class="tabs-panel tab-pane" id="search-class">
                      <p class="quick-search-wrap">
                        <input type="search" class="quick-search" title="搜索" value="" placeholder="搜索">
                      </p>
                    </div>
                    <p class="button-controls clearfix">
                      <span class="list-controls">
                        <a href="" class="select-all">全选</a>
                      </span>
                      <span class="add-to-menu">
                        <input type="submit" class="button-secondary submit-add-to-menu " value="添加至菜单">
                        <span class="spinner"></span>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="l-menu-management">
          <div class="menu-management">
            <div class="menu-edit">
              <div class="nav-menu-header">
                <div class="major-publishing-actions clearfix">
                  <label class="menu-name-label howto open-label" >
                    <span>菜单名称</span>
                    <input type="hidden" value="<?php echo isset($menuItem)?$menuItem['id']:'';?>" class="js-current-menu-id">
                    <input name="menu-name" type="text" class="menu-item-textbox menu-name js-menu-name" title="在此输入菜单名称" value="<?php echo isset($menuItem)?$menuItem['name']:'';?> ">
                  </label>
                  <div class="publishing-action">
                    <input type="submit" name="save_menu" class="button button-primary menu-save" value="保存菜单">
                  </div><!-- END .publishing-action -->
                </div>
              </div>
              <div class="post-body">
                <div class="post-body-content">
                  <h3>菜单结构</h3>
                  <div class="drag-instructions post-body-plain">
                    <p>拖放各个项目到您喜欢的顺序，点击右侧的箭头可进行更详细的设置。</p>
                  </div>
                  <div class=js-menu-order>
                    <ol class="menu-item-contain js-menu-dragable">
        
                    </ol>
                  </div>
                </div>
              </div>
              <div class="nav-menu-footer">
                <div class="major-publishing-actions clearfix">
                  <span class="delete-action ">
                    <a class="submitdelete deletion menu-delete js-delete-menu" href="<?php echo Yii::app()->createUrl('menu/delete',array('id'=>$menuItem['id']));?>">删除菜单</a>
                  </span><!-- END .delete-action -->
                  <div class="publishing-action">
                    <input type="submit" name="save_menu" class="button button-primary menu-save js-save-menuOrder" value="保存菜单">
                  </div><!-- END .publishing-action -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="tab-pane" id="ManagePosition">profile</div>
</div>
