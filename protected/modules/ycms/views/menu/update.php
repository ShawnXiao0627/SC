<div>
  <form action="<?php echo Yii::app()->createUrl('menu/update'); ?>" method="post">
    <label class="col-sm-2 control-label">Update Menu</label>
    <h4>Id:<?php echo $model->id?></h4>
    <input type="hidden" name="id" value="<?php echo $model->id?>">
    <input class="form-control" id="focusedInput" type="text" name="name" value="<?php echo $model->name?>" placeholder="Please enter menu name...">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
