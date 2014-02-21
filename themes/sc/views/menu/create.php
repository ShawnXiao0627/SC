<div>
  <form action="<?php echo Yii::app()->createUrl('menu/save'); ?>" method="post">
    <label class="col-sm-2 control-label">Create Menu</label>
    <input class="form-control" id="focusedInput" type="text" name="name" placeholder="Please enter menu name...">
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>