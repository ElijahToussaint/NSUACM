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
  <title>NSU ACM | Delete Project</title>
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
  $id = $_GET['id'];
  $sql = 'SELECT * FROM projects WHERE id="'.$id.'"';
  $result = mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row = mysqli_fetch_array($result);
  if(isset($_POST['confirm'])){
    $deleteSql = "DELETE FROM projects WHERE id='".$id."'";
    if(mysqli_query($mysqli,$deleteSql)){
      $success = "The project was successfully deleted.";
      header("Location: projects");
    }
    else {
      $error = "An error occured while deleting the project.";
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
      <a href="projects" class="section">Projects</a>
      <div class="divider"> / </div>
      <div class="active section"><?php echo $row['name']; ?></div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <p>Are you sure you want to delete <?php echo $row['name']; ?> from Projects?</p>
          <input type="hidden" name="confirm" value="true" />
        </div>
        <input type="submit" class="ui small black button" value="Yes" />
        <a href="projects" class="ui small red button">No</a>
      </div>
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
