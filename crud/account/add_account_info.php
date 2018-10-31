<?php

require_once "pdo.php";

session_start();


if ( isset($_POST['acc_name']) && isset($_POST['acc_type'])
 && isset($_POST['user_id'])) 
{

    // Data validation
 
   if ( strlen($_POST['acc_name']) < 1 || strlen($_POST['acc_type']) < 1 || strlen($_POST['user_id'])<1)
     {

        $_SESSION['error'] = 'Missing data';
 
       header("Location: add_acc_info.php");

       return;

     }


     $sql = "INSERT INTO account (acc_name, acc_type, user_id, curr_balance)

            VALUES (:acc_name, :acc_type, :user_id, :curr_balance)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute(array(
 ':acc_name' => $_POST['acc_name'],':acc_type' => $_POST['acc_type'],
':user_id' => $_POST['user_id'], ':curr_balance' => $_POST['curr_balance']));
    $_SESSION['success'] = 'Record Added';

    header( 'Location: index_account_info.php' ) ;

    return;

}

// Flash pattern

if ( isset($_SESSION['error']) )
    {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";

    unset($_SESSION['error']);
}
?>

<p>Add A New Account</p>

<form method="post">

<p>Acc_Name:
<input type="text" name="acc_name"></p>

<p>Acc_Type:
<input type="text" name="acc_type"></p>

<p>UserId:
<input type="text" name="user_id"></p>


<p>Opening_Balance:
<input type="number" name="curr_balance"></p>


<p><input type="submit" value="Add New"/>

<a href="../start.php">Cancel</a>
</p>

</form>
