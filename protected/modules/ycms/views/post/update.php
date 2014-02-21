<link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/post/postmain.css';?>" />
<div class="l-head head-index clearfix">
    <div class="head-index__title icon pull-left"></div>
    <h3 class="pull-left">编辑文章</h3>
    <a href="<?php echo Yii::app()->createUrl('post/create');?>" class="head-index__create-btn btn btn-default btn-xs pull-left">写文章</a>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'editCategory' => $categoryId, 'isUpdate' => true)); ?>
