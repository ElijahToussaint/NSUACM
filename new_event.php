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
  <title>NSU ACM | New Event</title>
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
    if ($_POST['submit']) {
      $name = $_POST['name'];
      $location = $_POST['location'];
      $start_datetime = date('Y-m-d H:i:s', strtotime($_POST['start_date']." ".$_POST['start_time']));
      $end_datetime = date('Y-m-d H:i:s', strtotime($_POST['end_date']." ".$_POST['end_time']));
      $timestamp = date('Y-m-d H:i:s', strtotime("now"));
      $description = bbcode_to_html($_POST['description']);
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
      elseif ($start_datetime >= $end_datetime) {
        $error = 'The start event time and date should be before the end event time and date.';
      }
      else {
        $sql='INSERT INTO events (name, location, start_datetime, end_datetime, description, posted_timestamp) VALUES ("'.$name.'", "'.$location.'", "'.$start_datetime.'", "'.$end_datetime.'", "'.$description.'", "'.$timestamp.'")';
        $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
        $success='Event has been added successfully.';
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
      <div class="active section">New Event</div>
    </div>
    <div class="ui section divider"></div>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="ui form">
        <div class="field">
          <label>Event Name</label>
          <input type="text" name="name" required />
        </div>
        <div class="field">
          <label>Event Location</label>
          <input type="text" name="location" required />
        </div>
        <div class="field">
          <label>Event Start Date</label>
          <input type="date" name="start_date" required />
        </div>
        <div class="field">
          <label>Event Start Time</label>
          <input type="time" name="start_time" required />
        </div>
        <div class="field">
          <label>Event End Date</label>
          <input type="date" name="end_date" required />
        </div>
        <div class="field">
          <label>Event End Time</label>
          <input type="time" name="end_time" required />
        </div>
        <div class="field">
          <label>Event Description</label>
          <textarea name="description" required></textarea>
        </div>
        <input type="submit" class="ui small black button" name=submit value="Submit">
      </div>
    </form>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
