<?php
session_start();

require 'pdo.php';


if(isset($_POST['login'])) 
 {
 
    $admin = $_POST['admin_name'];
    $pass = $_POST['admin_key'];

    if(empty($admin) || empty($pass) )
       {
        $message = 'All field are required';  
       }
   else
       {
        $query = $pdo->prepare("SELECT admin_name, admin_key FROM admin");
        $query->execute(array());
        $row = $query->fetch(PDO::FETCH_BOTH);

        if($query->rowCount() > 0) 
       		{
  		$_SESSION['name'] = $admin;
  		header('start.php');
       		}
        else
       		{
  		$message = "Admin_name/Password is wrong";
  		}


	}

}
?>

<!DOCTYPE html>
<html>
<head>
Admin Login
</head>
<body>
<?php
if(isset($message)) {
echo $message;
}
?>
<form action="#" method="post">
Admin_Name: <input type="text" name="admin_name" placeholder="name"> 
 <br/><br/>
Password: <input type="password" name="admin_key" placeholder="password">

<br/><br/>
<input type="submit" name="login" value="Login">

</form>

</html>