<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/bootstrap.css'; ?>" />
        <link rel="stylesheet" href="<?php echo $this->module->assetsUrl . '/css/user/usermain.css'; ?>" />
        <script src="<?php echo $this->module->assetsUrl . '/js/plugin/jquery-1.10.2.js'; ?>"></script>
        <script src="<?php echo $this->module->assetsUrl . '/js/lib/underscore.min.js'; ?>"></script>
        <script src="<?php echo $this->module->assetsUrl . '/js/lib/bootstrap.js'; ?>"></script>
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>
    
    <body>
      <div class="l-wrapper gradual-change">
        <div class="l-content container clearfix">
          <div id="alert_message" class="alert fade in hide">
              <button class="close" type="button">×</button>
              <span></span>
          </div>
            <?php echo $content; ?>
        </div>
      </div>
    </body>
</html>
