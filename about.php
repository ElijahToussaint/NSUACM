<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, about" />
  <meta name="author" content="Elijah Toussaint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | About</title>
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
    <h1 class="ui header">NSU ACM Chapter</h1>
    <p>The ACM student chapter at NSU is a technology club for students interested in anything tech. We work on technical projects, host technical workshops and host events. Anyone is welcome to join regardless of major or degree level. As long as you are an NSU student, you can come to any of our meetings and events. If you want to work on tehcnical projects, you will need development experience.</p>
    <div class="ui section divider"></div>
    <div class="ui three stackable cards">
      <?php
      $sql='SELECT * FROM eboard';
      $result = mysqli_query($mysqli,$sql) or die(mysqli_error());
      while($row = mysqli_fetch_array($result)){
        ?>
        <div class="card">
          <div class="image">
            <?php
            if(isset($_SESSION['username'])){
              ?>
              <a href="photo_eboard?id=<?php echo $row['id']; ?>" class="ui black left corner label">
                <i class="photo link icon"></i>
              </a>
              <?php
            }
            ?>
            <img src="<?php echo $row['avatar']; ?>">
          </div>
          <div class="content">
            <h2 class="ui header truncate"><a href="eboard?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a>
              <div class="sub header truncate"><?php echo $row['position']; ?></div>
            </h2>
          </div>
          <?php
          if(isset($_SESSION['username'])){
            ?>
            <div class="extra content">
              <a href="edit_eboard?id=<?php echo $row['id']; ?>" class="ui small black button">Edit</a>
              <a href="delete_eboard?id=<?php echo $row['id']; ?>" class="ui small red button">Delete</a>
            </div>
            <?php
          }
          ?>
        </div>
        <?php
      }
      ?>
      <?php
      if(isset($_SESSION['username'])){
        ?>
        <a href="new_eboard" class="card">
          <div class="image">
            <img src="assets/blank.jpg">
          </div>
          <div class="content">
            <h2 class="ui grey center aligned header">
              Add New Member
            </h2>
          </div>
        </a>
        <?php
      }
      ?>
    </div>
    <div class="ui section divider"></div>
    <h1 class="ui header">National ACM Chapter</h1>
    <p>ACM, the world's largest educational and scientific computing society, delivers resources that advance computing as a science and a profession. ACM provides the computing field's premier Digital Library and serves its members and the computing profession with leading-edge publications, conferences, and career resources.</p>
    <a href="http://www.acm.org" target="_blank">http://www.acm.org</a>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
