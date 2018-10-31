<?php
session_start();

require 'pdo.php';


if(isset($_POST['login'])) 
 {
 
    $user = $_POST['name'];
    $pass = $_POST['password'];

    if(empty($user) || empty($pass) )
       {
        $message = 'All field are required';  
       }
   else
       {
        $query = $pdo->prepare("SELECT name, password,user_id FROM user_info WHERE name=? AND password=? ");
        $query->execute(array($user,$pass));
        $row = $query->fetch(PDO::FETCH_ASSOC);
	

        if($query->rowCount() > 0) 
       		{
		
  		$_SESSION['name'] = $user;
	
  		header('Location:start.php?');
       		}
        else
       		{
  		$message = "Username/Password is wrong";
  		}


	}

}
?>

<!DOCTYPE html>
<html>
<head>
User Login
</br>
</head>
<body>
<?php
if(isset($message)) {
echo $message;
}
?>
<form action="#" method="post">
Username: <input type="text" name="name" placeholder="name"> 
 <br/><br/>
Password: <input type="password" name="password" placeholder="password">

<br/><br/>
<input type="submit" name="login" value="Login">
<a href="user_info/add_user_info.php">SignUp</a>
</form>

</html>