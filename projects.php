<?php
require('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="description" content="Learn more about the NSU ACM chapter." />
  <meta name="keywords" content="association of computing machinery, acm, nsu, nova southeastern university, about, chapter, organization, club, computer science, computer engineering, information technology, network security, ieee, ais, project, projects" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>NSU ACM | Projects</title>
  <!-- Frontend Framework CSS -->
  <?php
  require ('header.php');
  ?>
</head>
<body>
  <?php
  $pagnationSql = 'SELECT COUNT(*) FROM projects';
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
  $sql = 'SELECT * FROM projects ORDER BY posted_timestamp DESC '.$limit.'';
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
  <!-- site navbar -->
  <?php
  require ('navbar.php');
  ?>
  <!-- body -->
  <div class="ui main text container">
    <h1 class="ui header">Projects</h1>
    <p>View current, upcoming, and completed projects the ACM members worked on.</p>
    <p><a href="mailto:acmnovasoutheastern@gmail.com">To submit an idea email acmnovasoutheastern@gmail.com</a></p>
    <div class="ui section divider"></div>
    <?php
      if(isset($_SESSION['username'])){
    ?>
    <a href="new_project" class="ui small black button">
      Add New Project
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
            <a href="project?id=<?php echo $row['id']; ?>" class="header"><?php echo $row['name']; ?></a>
            <div class="meta">
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
            <div class="description">
              <?php
              if (strlen($row['description']) > 200)
              {
                //Truncate string
                $stringCut = substr($row['description'], 0, 200);
                //Make sure it ends in a word so assassinate doesn't become ass...
                $string = strip_tags($stringCut). "... <a href='project?id=".$row['id']."'>Additional Details</a>";
                echo '<p>'.$string.'</p>';
              }
              else
              {
                echo '<p>'.$row['description'].'</p>';
              }
              ?>
            </div>
            <div class="extra">
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
            </div>
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
