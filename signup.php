<?php session_start(); ?>
<?php require 'includes/conn.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php signup($conn); ?>

     <!DOCTYPE html>
     <html>
       <head>
         <meta charset="utf-8">
         <title>Login-System</title>
         <link rel="stylesheet" href="css/master.css">
       </head>
       <body>

<?php include 'includes/nav.php'; ?>

<?php if(isset($_SESSION['u_id'])) {
  echo 'You are logged in';
} else {
  echo '<div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12">
        <h1>Signup Here</h1>';
  echo '<form action="'. $_SERVER['PHP_SELF'].'" method="POST">';
  echo '<label for="">Username</label><input type="text" name="uid" placeholder="Username" required><br/>
        <label for="">Email</label><input type="email" name="email" placeholder="E-mail" required><br/>
        <label for="">Password</label><input type="password" name="pwd" required><br />
        <label for=""></label><button type="submit" name="submit">Opret</button>
            </form>
          </div>
        </div>
      </div>';
} ?>






  </body>
</html>
