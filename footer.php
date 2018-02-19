<!-- Website footer -->
<div class="ui inverted vertical footer segment">
  <div class="ui center aligned container">
    <div class="ui stackable inverted divided grid">
      <div class="four wide column">
        <h4 class="ui inverted header">More Links</h4>
        <div class="ui inverted link list">
          <a href="http://www.acm.org/" class="item">National ACM</a>
          <a href="http://orgsync.com/78824/chapter" class="item">OrgSync</a>
          <a href="http://groupme.com/join_group/37330818/3goJGg" class="item">GroupMe</a>
          <?php
          if(!isset($_SESSION['username'])){
            ?>
            <a href="login.php" class="item">Webmaster Login</a>
            <?php
          }
          else{
            ?>
            <a href="logout.php" class="item">Logout</a>
            <?php
          }
          ?>
        </div>
      </div>
      <div class="twelve wide column">
        <h4 class="ui inverted header">Social Media</h4>
        <p>Follow us on social media to stay updated!</p>
        <div class="ui horizontal inverted list">
          <a class="item" href="https://www.instagram.com/nsu_acm/" target="_blank"><i class="large instagram icon" title="Instagram"></i></a>
          <a class="item" href="https://discord.gg/FaW6twu" target="_blank"><i class="large linkify icon" title="Discord"></i></a>
          <a class="item" href="mailto:acmnovasoutheastern@gmail.com" target="_blank"><i class="large mail icon" title="Email"></i></a>
          <a class="item" href="https://github.com/nsuacm" target="_blank"><i class="large github icon" title="GitHub"></i></a>
        </div>
      </div>
    </div>
    <div class="ui inverted section divider"></div>
    <p>Copyright © 2018 NSU ACM. All Rights Reserved.</p>
  </div>
</div>
