<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | Home</title>
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
    <img class="ui fluid image" src="assets/nsu_acm.jpg">
    <h1 class="ui center aligned header">Welcome to the NSU ACM website!
      <div class="sub header">"The science of today is the technology of tomorrow." ~ Edward Teller</div>
    </h1>
    <div class="ui section divider"></div>
    <div class="ui three stackable cards">
      <div class="card">
        <div class="image">
          <img src="assets/img001.jpg">
        </div>
        <div class="content">
          <p>Learn more about the NSU ACM chapter and it's eboard members.</p>
        </div>
        <div class="extra content">
          <a href="about" class="ui secondary button">Learn More</a>
        </div>
      </div>
      <div class="card">
        <div class="image">
          <img src="assets/img003.jpg">
        </div>
        <div class="content">
          <p>Stay updated on recent and current events regarding the NSU ACM chapter.</p>
        </div>
        <div class="extra content">
          <a href="events" class="ui secondary button">Learn More</a>
        </div>
      </div>
      <div class="card">
        <div class="image">
          <img src="assets/img010.jpg">
        </div>
        <div class="content">
          <p>View all projects worked on by NSU ACM chapter students.</p>
        </div>
        <div class="extra content">
          <a href="projects" class="ui secondary button">Learn More</a>
        </div>
      </div>
    </div>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
