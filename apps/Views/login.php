<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="<?php echo Base_URL?>public/css/form.css?v=123" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <form autocomplete="off" action="<?php echo Base_URL?>index/authentication_login" method="POST">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" name="Username" placeholder="Username" required />
          <i class="bx bxs-user"></i>
        </div>
        <div class="input-box">
          <input type="password"  name="Password" placeholder="Password" required />
          <i class="bx bxs-lock"></i>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox" /> Remember me</label>
          <a href="#">Forgot password ?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register-link">
          <p>Don't have account ? <a href="#">Register</a></p>
        </div>
      </form>
    </div>
  </body>
</html>
