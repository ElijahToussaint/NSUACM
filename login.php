<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, login" />
  <meta name="author" content="Elijah Toussaint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | Login</title>
  <?php
  require('header.php');
  ?>
  <style type="text/css">
  body {
    background-color: #DADADA;
  }
  body > .grid {
    height: 100%;
  }
  </style>
</head>
<body>
  <?php
  require('navbar.php');
  ?>
  <?php
  if(isset($_POST['submit'])){
    $username = hash('sha512', 'username');
    $password = hash('sha512', 'password');
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];
    if($username != hash('sha512', $inputUsername)){
      $error = 'The wrong username';
    }
    else if($password != hash('sha512', $inputPassword)){
      $error = 'The wrong password';
    }
    else {
      $_SESSION['username'] = $inputUsername;
      $success = 'You have successfully logged in.';
      header('Location: index.php');
    }
  }
  ?>
  <div class="ui middle aligned center aligned grid" style="padding: 0px 10px;">
    <div class="column" style="max-width: 450px;">
      <h2 class="ui header">
        <div class="content">
          Log-in to your account
        </div>
      </h2>
      <form action="" method="post" enctype="multipart/form-data" class="ui large form">
        <div class="ui segment">
          <?php
          if (isset($success))
          {
            echo '<div class="ui positive message"><p>'.$success.'</p></div>';
          }
          if (isset($error))
          {
            echo '<div class="ui negative message"><p>'.$error.'</p></div>';
          }
          ?>
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
          </div>
          <input type="submit" name="submit" value="Login" class="ui fluid large black submit button" />
        </div>
      </form>
    </div>
  </div>
  <?php
  require('footer.php');
  ?>
</body>
</html>
