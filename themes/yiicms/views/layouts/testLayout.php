<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="language" content="en" />
      <?php $baseUrl = Yii::app()->theme->baseUrl; ?>
      
  <!-- blueprint CSS framework -->
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/screen.css';?>" media="screen, projection" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/print.css';?>" media="print" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/main.css';?>" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/form.css';?>" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/bootstrap.css'; ?>" />
      <link rel="stylesheet" href="<?php echo $baseUrl . '/css/plugin/jqpagination.css'; ?>" />
      <script type="text/javascript">
        var basePath = "<?php echo Yii::app()->request->baseUrl; ?>";
        var baseThemePath = "<?php echo Yii::app()->theme->baseUrl; ?>";
        var baseHomeUrl = "<?php echo Yii::app()->homeUrl; ?>";
      </script>
  
      <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>
      <div class="container" id="page">
        <div id="header">
          <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
          <h2>header-content</h2>
        </div><!-- header -->
      
      <div id="alert_message" class="alert fade in hide">
        <button class="close" type="button">×</button>
        <span></span>
      </div>
        <?php echo $content; ?>
      <div class="clear"></div>
      <h2>footer-content</h2>
      <?php $this->beginContent('//layouts/footer'); ?>
      <?php $this->endContent(); ?>
    </div><!-- page -->
  </body>
</html>
