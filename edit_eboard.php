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
  <title>NSU ACM | Edit Eboard</title>
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
  $sql='SELECT * FROM eboard WHERE id='.$id.'';
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_array($result);
  ?>
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
        $_POST['description'] = 'I am a nova student.';
      }
      else {
        $updateSql='UPDATE eboard SET name="'.$name.'", email="'.$email.'", description="'.$description.'", position="'.$position.'" WHERE id="'.$id.'"';
        $updateResult = mysqli_query($mysqli,$updateSql);
        $success = 'Information has been updated successfully';
        header('Location: about');
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
      <div class="active section"><?php echo $row['name']; ?></div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Name</label>
          <input type="text" name="name" value="<?php echo $row['name']; ?>" required />
        </div>
        <div class="field">
          <label>Position</label>
          <input type="text" name="position" value="<?php echo $row['position']; ?>" required />
        </div>
        <div class="field">
          <label>Email</label>
          <input type="email" name="email" value="<?php echo $row['email']; ?>" required />
        </div>
        <div class="field">
          <label>Description</label>
          <textarea wrap="hard" name="description"><?php echo $row['description']; ?></textarea>
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
