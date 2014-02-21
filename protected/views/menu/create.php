<div class="menu">
      <form class="form-create" action="<?php echo Yii::app()->createUrl('menu/create'); ?>" method="post">
        <h2 class="form-signin-heading">Create Menu</h2>
        <input type="text" name="name" class="create-name">
        <p>
            <button class="btn btn-primary" type="submit">create</button>
        </p>
      </form>
</div>
