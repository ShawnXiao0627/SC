<div class="col-xs-6 col-sm-4">
  <form class="form-signin" action="<?php echo Yii::app()->createUrl('user/login'); ?>" method="post">
    <h2 class="form-signin-heading">Login</h2>
    <input type="text" name="user_login" class="form-control" placeholder="Username">
    <input type="password" name="user_pass" class="form-control" placeholder="Password">
    <label class="checkbox">
      <input type="checkbox" name="rememberMe" value="remember-me">Remember me
    </label>
    <p>
      <button class="btn btn-primary" type="submit">Sign In</button>
      <button class="btn btn-default" type="submit"><a href="<?php echo Yii::app()->createUrl('user/register'); ?>">Register</a></button>
    </p>
    <p>
      <a href="#">Forget password!</a>
    </p>
  </form>
</div>