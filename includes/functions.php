<?php

function signup($conn) {
  if(isset($_POST['submit'])) {

  $uid = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING) or die('Missing/Illegal name parameter');
  $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) or die('Missing/Illegal E-mail parameter');
  $pwd = filter_input(INPUT_POST, 'pwd') or die('Missing/Illegal Age parameter');

  if( empty($uid) || empty($email) || empty($pwd)) {
    header("Location:index.php?missingnameemailorage");
    exit();
  } elseif(!preg_match('/^[a-zA-z]*$/', $uid)) {
    header("Location:index.php?signupbadcharacter");
    exit();
  } else {
    $sql = "SELECT uid, email FROM user WHERE uid='$uid' AND email='$email'";
    $stmt2 = $conn->prepare($sql);
    $stmt2->execute();
    $stmt2->store_result();
    $result = $stmt2->num_rows;
    if($result > 0) {
      echo 'Username or Email: Already Exists in thee database';
    } else {
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO user(uid, email, pwd) VALUES(?, ?, ?)');
    $stmt->bind_param('sss', $uid, $email, $pwd);
    $stmt->execute();
    header("Location:index.php?login=success");
    exit();
      }
    }
  }
}



function login($conn) {

  if(isset($_POST['submit'])) {

  $uid = filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING) or die('MISSING/ILLEGAL USERNAME');
  $pwd = filter_input(INPUT_POST, 'pwd') or die('MISSING/ILLEGAL Password');

  if(empty($uid) || empty($pwd)) {
    header("Location:index.php?login=missinginformation");
    exit();
  } else {
    $sql = "SELECT id, uid, pwd FROM user WHERE uid=?";
    if (!$stmt = $conn->prepare($sql)) {
      header("Location:index.php?login=sqlfail");
      exit();
    } else {
    $stmt->bind_param('s', $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      echo $row['pwd'];
      $hash = $row['pwd'];
      if(password_verify($pwd, $hash)) {
        $_SESSION['u_id'] = $row['id'];
        $_SESSION['u_uid'] = $row['uid'];
        $_SESSION['u_email'] = $row['email'];
        header("Location:index.php?login=loginsuccess");
        exit();
      } else {
        header("Location:index.php?login=unsuccessful");
        exit();
      }
    } else {
      header("Location:index.php?login=Fetcherror");
      exit();
        }
      }
    }
  }
}



function nameinfo($conn) {

  $stmt = $conn->prepare("SELECT * FROM user WHERE id='{$_SESSION['u_id']}'");
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()) {

    echo '<div class="container-fluid">
    <div class="row"><div class="col-xs-12 col-md-12 col-lg-12">';
    echo '<h1>Your Secret information</h1>';
    echo 'Youre Logged in as: '.ucfirst($row['uid']);
    echo '<br/>Your Email: '.ucfirst($row['email']);
    echo '<br/>Your Number in the database: '.ucfirst($row['id']);
    echo '</div></div></div>';
  }
}



 ?>
