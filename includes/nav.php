<div class="navbar navbar-default">
  <ul class="nav navbar-nav pull-right">
    <li><a href="index.php">Index</a></li>
    <li><a href="signup.php">Signup</a></li>
    <li><?php if(isset($_SESSION['u_id'])) {
      echo '<a><form action="includes/logout.php" method="post">
        <button type="submit" name="submit">Logout</button>
      </form></a></li>';
    } ?>
  </ul>
</div>
