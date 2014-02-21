<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="language" content="en" />
      <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
      
  <!-- blueprint CSS framework -->
      
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/bootstrap.css'; ?>" />
     
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/font-awesome.min.css'; ?>" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/plugin/jqpagination.css'; ?>" />
       <link rel="stylesheet" href="<?php echo $baseUrl . '/css/global/main.css'; ?>" />
      <script type="text/javascript">
        var basePath = "<?php echo Yii::app()->request->baseUrl; ?>";
        var baseThemePath = "<?php echo Yii::app()->theme->baseUrl; ?>";
        var baseHomeUrl = "<?php echo Yii::app()->homeUrl; ?>";
      </script>
  
      <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
    <div class="containers clearfix" id="page">
      <div class="container__menu-nav">
        <?php $this->beginContent('//layouts/header'); ?>
        <?php $this->endContent(); ?>
      </div>
      <div class="container__content-manager">
         <?php echo $content; ?>
      </div>
    </div>
   
      <?php $this->beginContent('//layouts/footer'); ?>
      <?php $this->endContent(); ?>
    
  </body>
</html>
