  <div class="col-xs-6 col-sm-4 register">
    <h3>
      User Register
    </h3>
    <form action="<?php echo Yii::app()->createUrl('user/create'); ?>" method="POST">
      <div class="input-group">
        <label>Username:</label>
        <input type="text" name="user[user_login]" class="form-control" placeholder="Username">
      </div>
      <div class="input-group">
        <label>Password:</label>
        <input type="password" name="user[user_pass]" class="form-control" placeholder="Password">
      </div>
      <div class="input-group">
        <label>Password Confirm:</label>
        <input type="password" name="user[passwordConfirm]" class="form-control" placeholder="Username">
      </div>
      <div class="input-group">
        <label>Email:</label>
        <input type="text" name="user[user_email]" class="form-control" placeholder="Username">
      </div>
      <div class="input-group">
        <label>Nickname:</label>
        <input type="text" name="user[user_nickname]" class="form-control" placeholder="Username">
      </div>
      <!-- TODO -->
      <!-- 
      <div style="margin-top: 10px">
        <img src="captcha" id='captchaimg'><br>
        <label for='message'>Enter the code above here :</label>
        <br>
        <input id="6_letters_code" name="6_letters_code" type="text">
        <br>
        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh
        <br>
      </div> -->
      <input name="Submit" type="submit" value="Submit">
    </form>
  </div>
