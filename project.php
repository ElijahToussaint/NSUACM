<?php
require('config.php');
?>
<?php
  $id = $_GET['id'];
  $sql='SELECT * FROM projects WHERE id='.$id.'';
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, project, projects, <?php echo $row['name']; ?>" />
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
      <a href="projects" class="section">Projects</a>
      <div class="divider"> / </div>
      <div class="active section"><?php echo $row['name']; ?></div>
    </div>
    <div class="ui section divider"></div>
    <?php
      if(isset($_SESSION['username'])){
    ?>
    <a href="edit_project?id=<?php echo $row['id']; ?>" class="ui small black button">
      Edit Project
    </a>
    <?php
      }
    ?>
    <?php
      if(isset($_SESSION['username'])){
    ?>
    <a href="delete_project?id=<?php echo $row['id']; ?>" class="ui small red button">
      Delete Project
    </a>
    <?php
      }
    ?>
    <h1 class="ui header">
      <div class="content">
        <?php echo $row['name']; ?>
        <div class="sub header">
          <?php $timestamp = strtotime($row['posted_timestamp']); ?>
          <span>Posted: <?php echo date("m/d/Y", $timestamp); ?> at <?php echo date("g:i a", $timestamp); ?></span>
          <?php
          if ($row['status'] == 'completed') {
            ?>
            <span class="ui green label">
              Completed
            </span>
            <?php
          }
          else {
            ?>
            <span class="ui red label">
              Ongoing
            </span>
            <?php
          }
          ?>
        </div>
      </div>
    </h1>
    <h3 class="ui header">Description</h3>
    <p><?php echo $row['description']; ?></p>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
