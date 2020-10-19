<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>JS Bin</title>
</head>



<body>
<form method="POST">
<input type="text"name="uname">
<input type="password" name="pwd"><br>
<input type="password" name="rpwd"><br>
<input type="submit" name="button" value="sign">
</form>
<form  method="POST">
<input type="text"name="username">
<input type="password" name="password"><br>
<input type="submit" name="button" value="login">
</form>
</body>

<?php
//var_dump($_POST);
date_default_timezone_set('PRC');
$time=date('Y-m-d h:i:s', time());

include("./config.php");
if(array_key_exists('uname',$_POST) && $_POST['uname']){
  $conn = mysqli_connect($host,$user,$psw,$db,$port);
  if($_POST['pwd'] && $_POST['pwd']===$_POST['rpwd']){
    if(strlen($_POST['uname'])<=12){
      $sql="insert into users values(NULL,'".$_POST["uname"]."','".$_POST["pwd"]."','".$time."',NULL );";
      $result=mysqli_query($conn,$sql);
      var_dump($result);
      if($result){
        echo '<script>alert("注册成功");location.herf="./post.php";</script>';
      }else{
        echo '<script>alert("'.mysqli_error($conn).'");</script>';
      }
    }else{
      echo '<script>alert("用户名不符合规定")</script>';
    }   
  }else{
    echo '<script>alert("两次密码不同");location.herf="/post.php";</script>';
  }
  //mysqli_close($conn);
}else if(array_key_exists('username',$_POST) && $_POST['username']){
  $conn =new PDO('mysql:host=127.0.0.1;dbname=system',$user,$psw);
  //$conn = mysqli_connect($host,$user,$psw,$db,$port);
  $sql="select * from users where username='".$_POST["username"]."' and password='".$_POST["password"]."';";
  $s=$conn->prepare($sql);
  $s->bindParam($sql);
  $s->bindParam(':username',$_POST['username']);
  $s->bindParam(':password',$_POST['password']);
  $result=$s->execute();
  $result=$s->fetch();
  var_dump($result['username']);
  //var_dump($sql);
  //$result=mysqli_query($conn,$sql);
  if($result && array_key_exists(1,$result)){
    session_start();
    $_SESSION['username']=$_POST['username'];
    //var_dump($_SESSION);
    echo '<script>location.herf="./msg.php";alert("登入成功");</script>';
    header('location:./msg.php');
    //mysqli_close($conn);
  }else{
    $error=$s->errorInfo();
    var_dump($error);
    echo '<script>alert("登入失败")</script>';
  }
}else{
  echo "Error";
  exit();
}
?>
</html>
