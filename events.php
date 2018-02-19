<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, event, events" />
  <meta name="author" content="Elijah Toussaint" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | Events</title>
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
  $pagnationSql = 'SELECT COUNT(*) FROM events';
  $pagnationResult=mysqli_query($mysqli,$pagnationSql) or die(mysqli_error());
  $pagnationRow=mysqli_fetch_row($pagnationResult);
  //
  $pagnationRows = $pagnationRow[0];
  //
  $page_rows = 10;
  //
  $last = ceil($pagnationRows/$page_rows);
  //
  if($last < 1){
    $last = 1;
  }
  //
  $pagenum = 1;
  //
  if(isset($_GET['page'])){
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['page']);
  }
  //
  if ($pagenum < 1) {
    $pagenum = 1;
  }
  else if ($pagenum > $last) {
    $pagenum = $last;
  }
  //
  $limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
  $sql = 'SELECT * FROM events ORDER BY posted_timestamp DESC '.$limit.'';
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  //
  $paginationCtrls = '';
  //
  if($last != 1){
    //
    $paginationCtrls .= '<div class="ui pagination menu">';
    if ($pagenum > 1) {
      $previous = $pagenum - 1;
      $paginationCtrls .= '<a class="item" href="'.$_SERVER['PHP_SELF'].'?page='.$previous.'">Previous</a>';
      //
      for($i = $pagenum-4; $i < $pagenum; $i++){
        if($i > 0){
          $paginationCtrls .= '<a class="item" href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
        }
      }
    }
    //
    $paginationCtrls .= '<a class="active item">'.$pagenum.'</a>';
    //
    for($i = $pagenum+1; $i <= $last; $i++){
      $paginationCtrls .= '<a class="item" href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
      if($i >= $pagenum+4){
        break;
      }
    }
    //
    if ($pagenum != $last) {
      $next = $pagenum + 1;
      $paginationCtrls .= '<a class="item" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a>';
    }
  }
  $paginationCtrls .= '</div>';
  ?>
  <div class="ui main text container">
    <h1 class="ui header">Events</h1>
    <p>Check out events ACM has coming up!</p>
    <div class="ui section divider"></div>
    <?php
      if(isset($_SESSION['username'])){
    ?>
    <a href="new_event.php" class="ui small black button">
      Add New Event
    </a>
    <?php
      }
    ?>
    <div class="ui divided items">
      <?php
      while($row = mysqli_fetch_array($result)){
        ?>
        <div class="item">
          <div class="content">
            <a href="event.php?id=<?php echo $row['id']; ?>" class="header"><?php echo $row['name']; ?></a>
            <div class="meta">
              <?php $timestamp = strtotime($row['posted_timestamp']); ?>
              <span>Posted: <?php echo date("m/d/Y", $timestamp); ?> at <?php echo date("g:i a", $timestamp); ?></span>
            </div>
            <div class="description">
              <?php
              if (strlen($row['description']) > 200)
              {
                //Truncate string
                $stringCut = substr($row['description'], 0, 200);
                //Make sure it ends in a word so assassinate doesn't become ass...
                $string = strip_tags($stringCut). "... <a href='event.php?id=".$row['id']."'>Additional Details</a>";
                echo '<p>'.$string.'</p>';
              }
              else
              {
                echo '<p>'.$row['description'].'</p>';
              }
              ?>
            </div>
            <?php
              if(isset($_SESSION['username'])){
            ?>
            <div class="extra">
              <a href="edit_event.php?id=<?php echo $row['id']; ?>" class="ui small black button">
                Edit Event
              </a>
              <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="ui small red button">
                Delete Event
              </a>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
    <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
  </div>
  <!-- footer -->
  <?php
  require ('footer.php');
  ?>
</body>
</html>
