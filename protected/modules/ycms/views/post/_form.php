<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/post/postform.css';?>" />
<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/js/kindeditor/themes/default/default.css';?>" />
<script data-main="<?php echo $this->module->assetsUrl; ?>/js/index.js" data-start="controller/postform.controller,controller/post.controller" src="<?php echo $this->module->assetsUrl; ?>/js/lib/require.js"></script>

<?php
if (isset($model))
{
    $msg = $model->errors;
    $isNew = $model->getIsNewRecord();
}
else
{
    $msg = null;
    $isNew = true;
}
?>
<div class="form clearfix js-post-form">
  <form method="post" action="<?php echo !$isUpdate ? (Yii::app()->createUrl('post/create')) : (Yii::app()->createUrl('post/update',array('id' => $model->id))); ?>" class="form-horizontal">
    <div class="l-main-content main-content pull-left">
      <input type="hidden" name="post[guid]" value="<?php echo Yii::app()->request->hostInfo . Yii::app()->homeURL;?>">
      <input type="hidden" name="post[post_type]" value="page">
      <input type="text" class="form-control main_content__post-title" name="post[post_title]" placeholder="Please enter title" value="<?php echo $model->post_title; ?>"/>
      <div class="main-content__link">
        <strong>固定链接：</strong>
        <span>http:www.baidu.com</span>
        <button class="btn btn-default btn-xs" type="button">更改固定链接</button>
      </div>
      <button class="btn btn-default btn-xs" type="button"><span class="main-content__add-media"></span>添加媒体</button>
      <div class="main-content__text-editor">
          <textarea id="post_content" name="post[post_content]">
            <?php echo $model->post_content; ?>
          </textarea>
          <div class="main-content__editor_status_bar">
            <span>字数：</span><span class="js-editor-count"></span>
            <span class="js-content-save-status pull-right">草稿保存于下午4:25:12。</span>
          </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">摘要</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right "></span>
        </div>
        <div class="block-content">
          <textarea class="form-control" rows="2" name="post[post_excerpt]"><?php echo $model->post_excerpt; ?></textarea>
          <span>摘要是您可以手动添加的内容概要，一些主题会用到这些文字。了解关于人工摘要的更多信息。</span>
        </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">评论</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right "></span>
        </div>
        <div class="block-content">
          <span>允许评论：</span>
          <select name="post[comment_status]">
            <option value="open" <?php echo (COMMENT_OPEN === $model->comment_status) ? 'selected="selected"' : ''; ?>>是</option>
            <option value="close" <?php echo (COMMENT_CLOSE === $model->comment_status) ? 'selected="selected"' : ''; ?>>否</option>
          </select>
        </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">别名</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right "></span>
        </div>
        <div class="block-content">
          <input type="text" class="form-control nick-name-input" name="post[post_name]" value="<?php echo $model->post_name; ?>"/>
        </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">作者</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right "></span>
        </div>
        <div class="block-content">
          <select name='post[post_author]' class="form-control user-select js-load-all-user" data-author="<?php echo $model->post_author; ?>">
          </select>
        </div>
      </div>
    </div>
    <div class="l-side-bar">
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">发布</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right "></span>
        </div>
        <div class="block-content">
          <div class='publish-block'>
            <span>状态：
              <select class="form-control post-status-select" name="post[post_status]">
                <option value="publish" <?php echo (POST_PUBLISH === $model->post_status) ? 'selected="selected"' : ''; ?>>发布</option>
                <option value="draft" <?php echo (POST_DRAFT === $model->post_status) ? 'selected="selected"' : ''; ?>>草稿</option>
              </select>
            </span>
            
          </div>
          <div class="publich-btn clearfix">
            <button class="btn btn-default btn-xs pull-left" type="button">预览</button>
            <button class="btn btn-primary btn-xs pull-right" ><?php echo $isNew ? '发布':'编辑';?></button>
          </div>
        </div>
        
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">模板</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right"></span>
        </div>
        <div class="block-content">
          <select class="form-control js-add-post-module-file" name="post[post_module]">
          </select>
        </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">分类目录</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right"></span>
        </div>
        <div class="block-content">
          <select class="form-control js-all-category-content" name="post[post_category]" data-category="<?php echo $editCategory;?>">
            <option value="">未分类</option>
          </select>
        </div>
      </div>
      <div class="block">
        <div class="block-title clearfix">
          <h4 class="pull-left">标签</h4>
          <span class="toggle-icon block-title-toggle block-title-show js-bock-content pull-right"></span>
        </div>
        <div class="block-content">
          <span class="add-post-tag">
            <input type="text" class="form-control" name="post[post_tag]"/>
          </span>
          <span>多个标签请用英文逗号（,）分开</span>
        </div>
      </div>
    </div>
  </form>
</div><!-- form -->