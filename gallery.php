<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, gallery" />
  <meta name="author" content="Elijah Toussaint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | Gallery</title>
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
    <h1 class="ui header">Gallery</h1>
    <p>View the many adventures of ACM!</p>
    <div class="ui section divider"></div>
    <?php
      if(isset($_SESSION['username'])){
    ?>
    <a href="upload_gallery" class="ui small black button">Upload from computer</a>
    <br/><br/>
    <?php
      }
    ?>
    <div class="ui three stackable cards">
      <?php
      $sql = 'SELECT * FROM gallery';
      $result = mysqli_query($mysqli,$sql) or die(mysqli_error());
      while($row = mysqli_fetch_array($result)){
        ?>
        <div class="card">
          <a class="image fancybox" rel="ligthbox" href="assets/<?php echo $row['image'] ?>" style="background-image:url('assets/<?php echo $row['image'] ?>'); background-repeat: no repeat; background-size: cover; background-position: center; min-height: 200px;" data-fancybox="images" data-caption="<?php echo $row['title'] ?>">
          </a>
          <div class="content">
            <div class="description">
              <p class="truncate"><?php echo $row['title'] ?></p>
            </div>
          </div>
          <?php
            if(isset($_SESSION['username'])){
          ?>
          <div class="extra content">
            <a href="edit_gallery?id=<?php echo $row['id']; ?>" class="ui small black button">Edit</a>
            <a href="delete_gallery?id=<?php echo $row['id']; ?>" class="ui small red button">Delete</a>
          </div>
          <?php
            }
          ?>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
