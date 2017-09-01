<?php session_start(); ?>
<?php require 'includes/conn.php'; ?>
<?php include 'includes/functions.php'; ?>
<?php login($conn); ?>


     <!DOCTYPE html>
     <html>
       <head>
         <meta charset="utf-8">
         <title>Login-System</title>
         <link rel="stylesheet" href="css/master.css">
       </head>
       <body>

 <?php include 'includes/nav.php'; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <h1>Login Here</h1>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="">Username</label><input type="text" name="uid" placeholder="Username" required><br/>
        <label for="">Password</label><input type="text" name="pwd" required><br />
        <label for=""></label><button type="submit" name="submit">Login</button>
      </form>
    </div>
  </div>
</div>

<?php if(isset($_SESSION['u_id'])) {
    nameinfo($conn);
} ?>


  </body>
</html>
