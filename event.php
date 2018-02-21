<?php
require('config.php');
?>
<?php
$id = $_GET['id'];
$sql='SELECT * FROM events WHERE id='.$id.'';
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about NSU ACM events happening on and off campus." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, <?php echo $row['name']; ?>, event, events" />
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
      <a href="events" class="section">Events</a>
      <div class="divider"> / </div>
      <div class="active section"><?php echo $row['name']; ?></div>
    </div>
    <div class="ui section divider"></div>
    <?php
    if(isset($_SESSION['username'])){
      ?>
      <a href="edit_event?id=<?php echo $row['id']; ?>" class="ui small black button">
        Edit Event
      </a>
      <a href="delete_event?id=<?php echo $row['id']; ?>" class="ui small red button">
        Delete Event
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
        </div>
      </div>
    </h1>
    <h3 class="ui header">Location</h3>
    <p><?php echo $row['location']; ?></p>
    <h3 class="ui header">Start Date and Time</h3>
    <?php
    $start_datetime = strtotime($row['start_datetime']);
    ?>
    <p><?php echo date("m/d/Y", $start_datetime); ?> at <?php echo date("g:i a", $start_datetime); ?></p>
    <h3 class="ui header">End Date and Time</h3>
    <?php
    $end_datetime = strtotime($row['end_datetime']);
    ?>
    <p><?php echo date("m/d/Y", $end_datetime); ?> at <?php echo date("g:i a", $end_datetime); ?></p>
    <h3 class="ui header">Description</h3>
    <p><?php echo $row['description']; ?></p>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
