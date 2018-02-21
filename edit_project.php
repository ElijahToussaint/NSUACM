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
  <title>NSU ACM | Edit Project</title>
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
    $sql='SELECT * FROM projects WHERE id='.$id.'';
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    $row=mysqli_fetch_array($result);
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
        $updateSql='UPDATE projects SET name = "'.$name.'", description = "'.$description.'", status = "'.$status.'", posted_timestamp = "'.$timestamp.'" WHERE id="'.$id.'"';
        $updateResult=mysqli_query($mysqli,$updateSql) or die(mysqli_error());
        $success='Project has been updated.';
        header('Location: projects');
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
      <div class="active section">Edit Project</div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Project Name</label>
          <input type="text" name="name" value="<?php echo $row['name']; ?>" required />
        </div>
        <div class="field">
          <label>Project Description</label>
          <textarea name="description" required><?php echo $row['description']; ?></textarea>
        </div>
        <div class="inline fields">
          <label>Project Status:</label>
          <div class="field">
            <div class="ui radio checkbox">
              <input type="radio" name="status" value="ongoing" checked="checked" />
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
        <input type="submit" class="ui small black button" name="submit" value="Submit" />
      </div>
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
