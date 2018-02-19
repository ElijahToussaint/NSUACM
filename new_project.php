<?php
require('config.php');
?>
<?php
if(!isset($_SESSION['username'])){
  header('Location: index.php');
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
  <title>NSU ACM | New Project</title>
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
  if ($_POST['submit']) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $timestamp = date('Y-m-d H:i:s', strtotime("now"));
    if ($_POST['name'] == '') {
      $error = 'Project name is required.';
    }
    elseif ($_POST['status'] == '') {
      $error = 'Project status is required.';
    }
    elseif ($_POST['description'] == '') {
      $error = 'Project description is required.';
    }
    else {
      $sql='INSERT INTO projects (name, description, status, posted_timestamp) VALUES ("'.$name.'", "'.$description.'", "'.$status.'", "'.$timestamp.'")';
      $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
      $success='Project has been added successfully.';
      header('Location: projects.php');
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
      <a href="projects.php" class="section">Projects</a>
      <div class="divider"> / </div>
      <div class="active section">New Project</div>
    </div>
    <div class="ui section divider"></div>
    <form class="ui form" action="" method="post" enctype="multipart/form-data">
      <div class="field">
        <label>Project Name</label>
        <input type="text" name="name" required />
      </div>
      <div class="field">
        <label>Project Description</label>
        <textarea name="description" required></textarea>
      </div>
      <div class="inline fields">
        <label>Project Status:</label>
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="status" checked="checked" value="ongoing" />
            <label>Ongoing</label>
          </div>
        </div>
        <div class="field">
          <div class="ui radio checkbox">
            <input type="radio" name="status" value="completed" />
            <label>Completed</label>
          </div>
        </div>
      </div>
      <input type="submit" class="ui small black button" name=submit value="Submit" />
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
