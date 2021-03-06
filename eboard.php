<?php
require('config.php');
?>
<?php
  $id = $_GET['id'];
  $sql = 'SELECT * FROM eboard WHERE id='.$id.'';
  $result = mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about <?php echo $row['name']; ?> the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, <?php echo $row['name']; ?>" />
  <meta name="author" content="Elijah Toussaint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | <?php echo $row['name']; ?></title>
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
  <div class="ui main text container">
    <div class="ui breadcrumb">
      <a href="about.php" class="section">About</a>
      <div class="divider"> / </div>
      <div class="active section"><?php echo $row['name']; ?></div>
    </div>
    <div class="ui section divider"></div>
    <h1 class="ui header">
      <img src="<?php echo $row['avatar']; ?>" class="ui circular image">
      <div class="content">
        <?php echo $row['name']; ?>
        <div class="sub header"><?php echo $row['position']; ?></div>
      </div>
    </h1>
    <h3 class="ui header">Description</h3>
    <p><?php echo $row['description']; ?></p>
    <h3 class="ui header">Email</h3>
    <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
