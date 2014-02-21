<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/post/postmain.css';?>" />
<div class="l-head head-index clearfix">
    <div class="head-index__title icon pull-left"></div>
    <h3 class="pull-left">撰写新文章</h3>
</div>
<?php echo $this->renderPartial('_form', array('model' => $model,'editCategory' => null, 'isUpdate' => false)); ?>