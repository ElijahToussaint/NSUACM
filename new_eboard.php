<?php
require('config.php');
?>
<?php
if(!isset($_SESSION['username'])){
  header('Location: index');
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | New Eboard</title>
  <!-- Frontend Framework CSS -->
  <?php
  require ('header.php');
  ?>
</head>
<body>
  <!-- site navbar -->
  <?php
  require ('navbar.php');
  ?>
  <!-- body -->
  <?php
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $position = $_POST['position'];
    if($_POST['name'] == ''){
      $error = 'Eboard member name is required.';
    }
    elseif ($_POST['position'] == '') {
      $error = 'Eboard member position is required.';
    }
    elseif ($_POST['email'] == '') {
      $error = 'Eboard member email is required.';
    }
    elseif ($_POST['description'] == '') {
      $error = 'Eboard member description is required.';
    }
    else {
      // include ImageManipulator class
      require_once('ImageManipulator.php');

      if ($_FILES['avatar']['error'] > 0) {
        $error = 'Eboard profile picture is required.';
      } else {
        // array of valid extensions
        $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
        // get extension of the uploaded file
        $fileExtension = strrchr($_FILES['avatar']['name'], ".");
        // check if file Extension is on the list of allowed ones
        if (in_array($fileExtension, $validExtensions)) {
          $newNamePrefix = time() . '_';
          $manipulator = new ImageManipulator($_FILES['avatar']['tmp_name']);
          $width  = $manipulator->getWidth();
          $height = $manipulator->getHeight();
          $centreX = round($width / 2);
          $centreY = round($height / 2);
          // our dimensions will be 1000x1000
          $x1 = $centreX - 500; // 500 / 2
          $y1 = $centreY - 500; // 500 / 2

          $x2 = $centreX + 500; // 500 / 2
          $y2 = $centreY + 500; // 500 / 2

          // center cropping to 200x130
          $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
          // saving file to uploads folder
          $manipulator->save('assets/' . $newNamePrefix . $_FILES['avatar']['name']);
          $manipulator = 'assets/' . $newNamePrefix . $_FILES['avatar']['name'];
          $success = "Eboard member has been added.";
          $sql='INSERT INTO eboard (name, avatar, email, description, position) VALUES ("'.$name.'", "'.$manipulator.'", "'.$email.'", "'.$description.'", "'.$position.'")';
          $result = mysqli_query($mysqli,$sql);
          header('Location: about');
        } else {
          $error = "Sorry, there was an error uploading your file.";
        }
      }
    }
  }
  ?>
  <div class="ui main text container">
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
    <div class="ui breadcrumb">
      <a href="about" class="section">About</a>
      <div class="divider"> / </div>
      <div class="active section">New Eboard Member</div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Name</label>
          <input type="text" name="name" required />
        </div>
        <div class="field">
          <label>Upload Profile Image</label>
          <input id="txt" type="text" placeholder="Choose File" onclick ="javascript:document.getElementById('file').click();" required />
          <input type="file" id="file" style='display: none;' name="avatar" accept="image/*" onchange="ChangeText(this, 'txt');"/>
        </div>
        <div class="field">
          <label>Position</label>
          <input type="text" name="position" required />
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" required />
        </div>
        <div class="field">
          <label>Description</label>
          <textarea wrap="hard" name="description" required></textarea>
        </div>
        <input type="submit" class="ui small black button" name='submit' value="Submit" />
      </div>
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
