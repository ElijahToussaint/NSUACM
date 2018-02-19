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
  <title>NSU ACM | Edit Gallery Photo Title</title>
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
    $sql='SELECT * FROM gallery WHERE id='.$id.'';
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    $row=mysqli_fetch_array($result);
    if ($_POST['submit']) {
      $title = $_POST['title'];
      if ($_POST['title'] == '') {
        $error = 'Gallery photo title is required.';
      }
      else {
        $updateSql='UPDATE gallery SET title = "'.$title.'" WHERE id="'.$id.'"';
        $updateResult=mysqli_query($mysqli,$updateSql) or die(mysqli_error());
        $success='Event has been updated.';
        header('Location: gallery.php');
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
      <a href="gallery.php" class="section">Gallery</a>
      <div class="divider"> / </div>
      <div class="active section">Edit Gallery Photo Title</div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Title</label>
          <input type="text" name="title" value="<?php echo $row['title']; ?>" required />
        </div>
        <input type="submit" class="ui small black button" name=submit value="Submit" />
      </div>
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
