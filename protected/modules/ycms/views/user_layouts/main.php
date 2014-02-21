<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta charset="utf-8">
 <title><?php echo CHtml::encode($this->pageTitle); ?></title>
 <?php $baseUrl = $this->module->assetsUrl; ?>
 <link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/bootstrap.css'; ?>" />
 <script type="text/javascript">
   var basePath = "<?php echo Yii::app()->request->baseUrl; ?>";
   var baseThemePath = "<?php echo Yii::app()->theme->baseUrl; ?>";
   var baseHomeUrl = "<?php echo Yii::app()->homeUrl; ?>";
 </script>
</head>
<body>
  <div class="hfeed site">
    <?php $this->beginContent('//user_layouts/header'); ?>
    <?php $this->endContent(); ?>
  </div>
  <div class="site-main">
    <?php echo $content; ?>
  </div>
  <div class="site-footer">
    <?php $this->beginContent('//user_layouts/footer'); ?>
    <?php $this->endContent(); ?>
  </div>
</body>
</html>
