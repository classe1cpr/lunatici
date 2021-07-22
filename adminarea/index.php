<?php
session_start();
$conn=mysqli_connect('localhost','root','','lunatici');
//Getting Input value
if(isset($_POST['login'])){
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $password=mysqli_real_escape_string($conn,$_POST['password']);
  if(empty($username)&&empty($password)){
   $error= "<h1 class='error'>Inserire Username e Password!</h1>
   <br>";
  }else{
 //Checking Login Detail
 $result=mysqli_query($conn,"SELECT*FROM user WHERE username='$username' AND password='$password'");
 $row=mysqli_fetch_assoc($result);
 $count=mysqli_num_rows($result);
 if($count==1){
      $_SESSION['user']=array(
   'username'=>$row['username'],
   'password'=>$row['password'],
   'role'=>$row['role']
   );
   $role=$_SESSION['user']['role'];
   //Redirecting User Based on Role
    switch($role){
  case 'user':
  header('location:user.php?u='.$_SESSION['user']['username']);
  break;
  case 'moderator':
  header('location:moderator.php?m='.$_SESSION['user']['username']);
  break;
  case 'admin':
  header('location:admin.php?a='.$_SESSION['user']['username']);
  break;
 }
 }else{
 $error= "<h1 class='error'>Username e/o Password Errati!</h1>
 <br>";
 }
}
}
?>
<html>
<head>
<link rel="stylesheet" href="css/index.css">
<title>PHP MySQL Role Based Access Control</title>
</head>
<div align="center">
<h1 style="font-family: sans-serif;" class="title">Lunatici - Login</h1>
<?php if(isset($error)){ echo $error; }?>
<form method="POST" action="">
  <input type="text" name="username" class="input_text" placeholder="Username"/>
  <br>
  <br>
  <input type="text" name="password" class="input_text" placeholder="Password"/>
  <br>
  <br>
  <input type="submit" name="login" value="Login" class="input_submit"/>
</form>
</div>
</html>

<?php 
if($_SESSION['user']['username']){
   echo "sei loggato!";
}else{
   echo "non sei loggato!";
}
?>
