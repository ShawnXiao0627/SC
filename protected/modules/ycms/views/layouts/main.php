<?php /* @var $this Controller */
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="language" content="en" />
      <?php $baseUrl = $this->module->assetsUrl;?>
      
  <!-- blueprint CSS framework -->
      
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/bootstrap.css'; ?>" />
     
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/font-awesome.min.css'; ?>" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/plugin/jqpagination.css'; ?>" />
       <link rel="stylesheet" href="<?php echo $baseUrl . '/css/global/main.css'; ?>" />
      <script type="text/javascript">
        
        var baseThemePath = "<?php echo $this->module->assetsUrl; ?>";
        var baseHomeUrl = "<?php echo Yii::app()->baseUrl . '/' . $this->module->id; ?>";
      </script>
  
      <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
    <div class="containers clearfix" id="page">
      <div class="container__menu-nav">
        <?php $this->beginContent('/layouts/header'); ?>
        <?php $this->endContent(); ?>
      </div>
      <div class="container__content-manager">
         <?php echo $content; ?>
      </div>
    </div>
   
      <?php $this->beginContent('/layouts/footer'); ?>
      <?php $this->endContent(); ?>
    
  </body>
</html>
