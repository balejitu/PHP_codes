<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['name']) && isset($_POST['email'])
 && isset($_POST['password']) && isset($_POST['city'])) 
{

    // Data validation
 
   if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1 || strlen($_POST['city'])<1)
     {

        $_SESSION['error'] = 'Missing data';
 
       header("Location: add_user_info.php");

       return;

     }


   if ( strpos($_POST['email'],'@') === false )
     {

       $_SESSION['error'] = 'Bad data';

       header("Location: add_user_info.php");

       return;

     }

    $sql = "INSERT INTO user_info (name, email, password,city)

            VALUES (:name, :email, :password, :city)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
 ':name' => $_POST['name'],':email' => $_POST['email'],
':password' => $_POST['password'],':city' => $_POST['city']));
    $_SESSION['success'] = 'Record Added';

    header( 'Location: ../index.php' ) ;

    return;

}

// Flash pattern

if ( isset($_SESSION['error']) )
    {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);
}
?>

<p>Add A New User</p>

<form method="post">

<p>Name:
<input type="text" name="name"></p>

<p>Email:
<input type="text" name="email"></p>

<p>Password:
<input type="password" name="password"></p>

<p>City:<input type="text" name = "city"></p>
<p><input type="submit" value="Add New"/>

<a href="../index.php">Cancel</a>
</p>

</form>
