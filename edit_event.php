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
  <title>NSU ACM | Edit Events</title>
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
    $sql='SELECT * FROM events WHERE id='.$id.'';
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    $row=mysqli_fetch_array($result);
    $start_datetime = strtotime($row['start_datetime']);
    $end_datetime = strtotime($row['end_datetime']);
    if ($_POST['submit']) {
      $name = $_POST['name'];
      $location = $_POST['location'];
      $start_datetime = date('Y-m-d H:i:s', strtotime($_POST['start_date']." ".$_POST['start_time']));
      $end_datetime = date('Y-m-d H:i:s', strtotime($_POST['end_date']." ".$_POST['end_time']));
      $timestamp = date('Y-m-d H:i:s', strtotime("now"));
      $description = $_POST['description'];
      if ($_POST['name'] == '') {
        $error = 'Event name is required.';
      }
      elseif ($_POST['location'] == '') {
        $error = 'Event location is required.';
      }
      elseif ($_POST['start_date'] === false) {
        $error = 'Event start date is required.';
      }
      elseif ($_POST['$start_time'] === false) {
        $error = 'Event start time is required.';
      }
      elseif ($_POST['end_date'] === false) {
        $error = 'Event end date is required.';
      }
      elseif ($_POST['end_time'] === false) {
        $error = 'Event end time is required.';
      }
      elseif ($_POST['description'] == '') {
        $error = 'Event description is required.';
      }
      else {
        $updateSql='UPDATE events SET name = "'.$name.'", location = "'.$location.'", start_datetime = "'.$start_datetime.'", end_datetime = "'.$end_datetime.'", description = "'.$description.'", posted_timestamp = "'.$timestamp.'" WHERE id="'.$id.'"';
        $updateResult=mysqli_query($mysqli,$updateSql) or die(mysqli_error());
        $success='Event has been updated.';
        header('Location: events');
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
      <a href="events" class="section">Events</a>
      <div class="divider"> / </div>
      <div class="active section">Edit Event</div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Event Name</label>
          <input type="text" name="name" value="<?php echo $row['name']; ?>" required />
        </div>
        <div class="field">
          <label>Event Location</label>
          <input type="text" name="location" value="<?php echo $row['location']; ?>" required />
        </div>
        <div class="field">
          <label>Event Start Date</label>
          <input type="date" name="start_date" value="<?php echo date("Y-m-d", $start_datetime); ?>" required />
        </div>
        <div class="field">
          <label>Event Start Time</label>
          <input type="time" name="start_time" value="<?php echo date("H:i:s", $start_datetime); ?>" required />
        </div>
        <div class="field">
          <label>Event End Date</label>
          <input type="date" name="end_date" value="<?php echo date("Y-m-d", $end_datetime); ?>" required />
        </div>
        <div class="field">
          <label>Event End Time</label>
          <input type="time" name="end_time" value="<?php echo date("H:i:s", $end_datetime); ?>" required />
        </div>
        <div class="field">
          <label>Event Description</label>
          <textarea name="description" required><?php echo $row['description']; ?></textarea>
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
